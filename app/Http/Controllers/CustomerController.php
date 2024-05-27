<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends BaseController
{
    private $model = Customer::class;
    private $fields = [
        'CustomerName',
        'Gender',
        'PhoneNumber',
    ];
    private $idFeild = 'CustomerID';

    public function __construct()
    {
        parent::__construct($this->model, $this->fields, $this->idFeild);
    }
}
