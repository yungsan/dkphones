<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends BaseController
{
    private $model = Supplier::class;
    private $fields = [
        'SupplierName',
        'Email',
        'PhoneNumber'
    ];
    private $idFeild = 'SupplierID';
    public function __construct()
    {
        parent::__construct($this->model, $this->fields, $this->idFeild);
    }
}
