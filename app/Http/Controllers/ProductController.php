<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    private $model = Product::class;
    private $fields = [
        'SKU',
        'ProductName',
        'Priority',
        'Price',
        'ImageURL',
        'BrandID',
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
        'Status',
        'Priority'
    ];
    private $idFeild = 'ProductID';
    private $columns = [
        'BrandID',
        'ProductName'
    ];
    public function __construct()
    {
        parent::__construct($this->model, $this->fields, $this->idFeild);
    }

    public function searchSKUBySupplier(Request $request)
    {

        $data = Supplier::join('brands', 'brands.SupplierID', '=', 'suppliers.SupplierID')
            ->join('products', 'products.BrandID', '=', 'brands.BrandID')
            ->where('suppliers.SupplierID', $request->input('SupplierID'))
            ->select('SKU', 'ProductID', 'products.ProductName', 'suppliers.SupplierName')
            ->get();
        return $this->response(true, $data);
    }
}
