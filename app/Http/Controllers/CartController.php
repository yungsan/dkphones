<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartController extends Controller
{
    private $model = Cart::class;
    private $fields = [
        'CustomerID',
        'ProductID',
        'Quantity',
    ];



    public function buyNow(Request $request)
    {
        $CustomerID = auth()->user()['CustomerID'];
        $ProductID = $request->input('ProductID');
        if ($ProductID) {
            $Quantity = $request->input('Quantity');
            $product = Product::find($ProductID);

            $cart = Cart::where(
                'CustomerID',
                $CustomerID
            )->where('ProductID', $ProductID)->get();


            if (count($cart) > 0) {
                Cart::destroy($cart[0]['CartID']);
            }
            Cart::create([
                'CustomerID' => $CustomerID,
                'ProductID' => $ProductID,
                'Quantity' => $Quantity,
            ]);

            $product['Quantity'] = $Quantity;

            $total = $product['Price'] * $product['Quantity'];
            $product['Total'] = $product['Price'] * $product['Quantity'];


            return redirect()->route('checkout.page')->with([
                'Products' => [$product],
                'CustomerID' => $CustomerID,
                'Total' => $total

            ]);
        }


        $products = Product::join('carts', 'products.ProductID', '=', 'carts.ProductID')
            ->select('products.*', 'Quantity', DB::raw('(Quantity * Price) AS Total'))
            ->where('carts.CustomerID', $CustomerID)->get();

        $total = 0;
        for ($i = 0; $i < count($products); $i++) {
            $total += $products[$i]['Total'];
        }

        return redirect()->route('checkout.page')->with([
            'Products' => $products,
            'CustomerID' => $CustomerID,
            'Total' => $total,
            'Address' => auth()->user()['Address']
        ]);

    }

    public function addCart(Request $request)
    {
        $CustomerID = auth()->user()['CustomerID'];
        $carts = Cart::join('products', 'products.ProductID', '=', 'carts.ProductID')
            ->select('carts.*', 'Price', 'products.ProductName', 'ImageURL', 'SKU')->where('CustomerID', $CustomerID)->get();
        return view('pages/auth/cart', [
            'carts' => $carts
        ]);
    }
    public function addToCart(Request $request)
    {
        $CustomerID = auth()->user()['CustomerID'];
        $ProductID = $request->input('ProductID');
        $Quantity = $request->input('Quantity');
        $cart = Cart::where(
            'CustomerID',
            $CustomerID
        )->where('ProductID', $ProductID)->get();



        if (count($cart) > 0) {
            $oldQuantity = $cart[0]->Quantity;
            $cart[0]->Quantity = $oldQuantity + $Quantity;

            $cart[0]->save();
            return;
        }

        Cart::create([
            'CustomerID' => $CustomerID,
            'ProductID' => $ProductID,
            'Quantity' => $Quantity,
        ]);

        return;
    }

    public function updateCart(Request $request)
    {
        $id = $request->input('CartID');
        $quantity = $request->input('Quantity');

        $cart = Cart::find($id);

        $cart->Quantity = $quantity;
        $cart->save();

        return;
    }

    public function deleteCart(Request $request)
    {
        $id = $request->input('CartID');
        Cart::destroy($id);

        return redirect('/cart');
    }
}
