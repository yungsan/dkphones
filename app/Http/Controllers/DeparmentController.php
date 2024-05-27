<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DeparmentController extends BaseController
{
    private $model = Department::class;
    private $fields = ['DepartmentName'];
    private $idFeild = 'DepartmentID';

    public function __construct()
    {
        parent::__construct($this->model, $this->fields, $this->idFeild);
    }
}
