<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('Status', 1)->orderBy('Priority', 'desc')->get();
        return view('pages/home', ['products' => $products]);
    }

    public function detail($id)
    {

        $product = Product::select(
            'ProductID',
            'Products.SKU',
            'ProductName',
            'Priority',
            'Products.Price',
            'ImageURL',
            'Products.BrandID',
            'Color',
            'Dimension',
            'Weight',
            'ScreenSize',
            'ScreenResolution',
            'FrontCamera',
            'RearCamera',
            'CPU',
            'RAM',
            'Power',
            'ChargingPort',
            'SIM',
            'Bluetooth',
            'HeadphoneJack',
            'Storage',
            'Remain'
        )->join('Batches', 'Batches.SKU', '=', 'Products.SKU')
            ->where('ProductID', $id)
            ->first();

        return view('pages/detail', ['product' => $product]);
    }

    public function product()
    {

        $products = Product::select(
            'ProductID',
            'Products.SKU',
            'ProductName',
            'Priority',
            'Products.Price',
            'ImageURL',
            'Products.BrandID',
            'Color',
            'Dimension',
            'Weight',
            'ScreenSize',
            'ScreenResolution',
            'FrontCamera',
            'RearCamera',
            'CPU',
            'RAM',
            'Power',
            'ChargingPort',
            'SIM',
            'Bluetooth',
            'HeadphoneJack',
            'Storage',
        )->get();

        return view('pages/product', ['products' => $products]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::select(
            'ProductID',
            'Products.SKU',
            'ProductName',
            'Priority',
            'Products.Price',
            'ImageURL',
            'Products.BrandID',
            'Color',
            'Dimension',
            'Weight',
            'ScreenSize',
            'ScreenResolution',
            'FrontCamera',
            'RearCamera',
            'CPU',
            'RAM',
            'Power',
            'ChargingPort',
            'SIM',
            'Bluetooth',
            'HeadphoneJack',
            'Storage',
        )->join('Brands', 'Brands.BrandID', '=', 'Products.ProductID')
            ->where('ProductName', 'like', '%' . $keyword . '%')
            ->orWhere('Price', 'like', '%' . $keyword . '%')
            ->orWhere('Color', 'like', '%' . $keyword . '%')
            ->orWhere('Dimension', 'like', '%' . $keyword . '%')
            ->orWhere('ScreenSize', 'like', '%' . $keyword . '%')
            ->orWhere('CPU', 'like', '%' . $keyword . '%')
            ->orWhere('RAM', 'like', '%' . $keyword . '%')
            ->orWhere('Power', 'like', '%' . $keyword . '%')
            ->orWhere('Bluetooth', 'like', '%' . $keyword . '%')
            ->orWhere('BrandName', 'like', '%' . $keyword . '%')
            ->get();

        return view('pages/search', ['products' => $products]);
    }

    public function profile()
    {
        $id = auth()->user()['CustomerID'];

        $orders = Order::select('orders.*', 'statuses.StatusName', DB::raw('COUNT(order_details.ProductID) AS ProductCount'))
            ->join('statuses', 'statuses.StatusID', '=', 'orders.StatusID')
            ->join('customers', 'customers.CustomerID', '=', 'orders.CustomerID')
            ->join('order_details', 'order_details.OrderID', '=', 'orders.OrderID')
            ->where('orders.CustomerID', $id)
            ->groupBy('orders.OrderID', 'statuses.StatusName')
            ->orderBy('orders.OrderID', 'desc')
            ->get();
        $user = auth()->user();
        return view('pages/auth/profile', [
            'user' => $user,
            'orders' => $orders
        ]);
    }

    public function editProfile(Request $request)
    {
        $id = auth()->user()['CustomerID'];
        $u = Customer::find($id);

        $u->CustomerName = $request->input('CustomerName');
        $u->Address = $request->input('Address');

        $u->save();
        return $u;

        // return redirect('/profile');
    }
}
