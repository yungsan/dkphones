<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;


class WarehouseController extends BaseController
{
    private $model = Warehouse::class;
    private $fields = [
        'WarehouseName',
        'PhoneNumber',
        'Address'
    ];
    private $idFeild = 'WarehouseID';
    public function __construct()
    {
        parent::__construct($this->model, $this->fields, $this->idFeild);
    }
}
