<?php

namespace App\Http\Controllers;

use App\Models\Batche;
use App\Models\ReceivedNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceivedNoteController extends BaseController
{
    private $model = ReceivedNote::class;
    private $fields = [
        'EmployeeID',
        'SupplierID',
        'WarehouseID',
        'BatcheID',
    ];
    private $idFeild = 'ReceivedNoteID';

    public function __construct()
    {
        parent::__construct($this->model, $this->fields, $this->idFeild);
    }

    #[\Override]
    public function getAll(Request $request)
    {
        if ($request->input($this->idFeild)) {
            return $this->getOne($request);
        }

        try {
            $receivedNotes = ReceivedNote::select(
                'received_notes.ReceivedNoteID',
                'employees.EmployeeName',
                'employees.EmployeeID',
                'suppliers.SupplierName',
                'suppliers.SupplierID',
                'warehouses.WarehouseName',
                'warehouses.WarehouseID',
                'received_notes.CreatedAt',
                'received_notes.UpdatedAt',
                DB::raw('SUM(batches.Price) as Total'),
                DB::raw('SUM(batches.Quantity) as ProductCount')
            )
                ->join('employees', 'employees.EmployeeID', '=', 'received_notes.EmployeeID')
                ->join('suppliers', 'suppliers.SupplierID', '=', 'received_notes.SupplierID')
                ->join('warehouses', 'warehouses.WarehouseID', '=', 'received_notes.WarehouseID')
                ->join('batches', 'batches.BatcheID', '=', 'received_notes.BatcheID')
                ->groupBy('received_notes.ReceivedNoteID')
                ->get();
            return $this->response(true, $receivedNotes);
        } catch (\Throwable $th) {
            return $this->response(false, $th);
        }
    }
    #[\Override]
    public function getOne(Request $request)
    {
        try {
            $receivedNotes = ReceivedNote::select(
                'received_notes.ReceivedNoteID',
                'employees.EmployeeName',
                'employees.EmployeeID',
                'suppliers.SupplierName',
                'suppliers.SupplierID',
                'warehouses.WarehouseName',
                'warehouses.WarehouseID',
                'received_notes.CreatedAt',
                'received_notes.UpdatedAt',
                DB::raw('SUM(batches.Price) as Total'),
                DB::raw('SUM(batches.Quantity) as ProductCount')
            )
                ->join('employees', 'employees.EmployeeID', '=', 'received_notes.EmployeeID')
                ->join('suppliers', 'suppliers.SupplierID', '=', 'received_notes.SupplierID')
                ->join('warehouses', 'warehouses.WarehouseID', '=', 'received_notes.WarehouseID')
                ->join('batches', 'batches.BatcheID', '=', 'received_notes.BatcheID')
                ->groupBy('received_notes.ReceivedNoteID')
                ->find($this->idFeild);
            return $this->response(true, $receivedNotes);
        } catch (\Throwable $th) {
            return $this->response(false, $th);
        }
    }
    #[\Override]
    public function create(Request $request)
    {
        $BatcheID = time();

        $batcheData = $request->input('BatcheData');

        for ($i = 0; $i < count($batcheData); $i++) {
            $batcheData[$i]['BatcheID'] = $BatcheID;
            $batcheData[$i]['Remain'] = $batcheData[$i]['Quantity'];
        }

        try {
            $batche = Batche::insert($batcheData);
            $rn = ReceivedNote::create([
                'EmployeeID' => $request->input('EmployeeID'),
                'SupplierID' => $request->input('SupplierID'),
                'WarehouseID' => $request->input('WarehouseID'),
                'BatcheID' => $BatcheID,
            ]);

            return $this->response(true, $rn);
        } catch (\Throwable $th) {
            return $this->response(false, $th);
        }


    }
}
