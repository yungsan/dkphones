<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends BaseController
{
    private $model = Brand::class;
    private $fields = [
        'BrandName',
        'SupplierID',
    ];
    private $idFeild = 'BrandID';
    private $columns = [
        'BrandID',
        'BrandName',
        'Brands.SupplierID as SupplierID',
        'SupplierName'
    ];
    public function __construct()
    {
        parent::__construct($this->model, $this->fields, $this->idFeild);
    }

    #[\Override]
    public function getAll(Request $request)
    {
        if ($request->input()) {

            return $this->getOne($request);
        }

        $employees = $this->model::select($this->columns)
            ->leftJoin('Suppliers', 'Suppliers.SupplierID', '=', 'Brands.SupplierID')
            ->get();

        return $this->response(true, $employees);
    }

    #[\Override]
    public function getOne(Request $request)
    {
        $id = $request->input($this->idFeild);
        $data = $this->model::select($this->columns)
            ->leftJoin('Suppliers', 'Suppliers.SupplierID', '=', 'Brands.SupplierID')
            ->find($id);

        return $this->response(true, $data);
    }
}
