<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends BaseController
{
    private $model = Employee::class;
    private $fields = [
        'EmployeeName',
        'EmployeeEmail',
        'Gender',
        'PhoneNumber',
        'Salary',
        'DepartmentID',
        'PositionID',
    ];
    private $idFeild = 'EmployeeID';
    private $tableName = 'Employees';
    private $columns = [
        'EmployeeID',
        'EmployeeName',
        'EmployeeEmail',
        'Salary',
        'Employees.DepartmentID as DepartmentID',
        'Employees.PositionID as PositionID',
        'PositionName as Position',
        'DepartmentName as Department',
        'PhoneNumber',
        'Gender'
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
            ->leftJoin('Departments', 'Departments.DepartmentID', '=', 'Employees.DepartmentID')
            ->LeftJoin('Positions', 'Positions.PositionID', '=', 'Employees.PositionID')
            ->orderByDesc($this->columns[0])
            ->get();

        return $this->response(true, $employees);
    }

    #[\Override]
    public function getOne(Request $request)
    {
        $id = $request->input($this->idFeild);
        $employees = Employee::select($this->columns)
            ->leftJoin('Departments', 'Departments.DepartmentID', '=', 'Employees.DepartmentID')
            ->LeftJoin('Positions', 'Positions.PositionID', '=', 'Employees.PositionID')
            ->find($id);

        return $this->response(true, $employees);
    }

    public function getShipper()
    {
        $employees = Employee::where('DepartmentID', 4)->get();

        return $this->response(true, $employees);
    }

}
