<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends BaseController
{
    private $model = Position::class;
    private $fields = ['PositionName'];
    private $idFeild = 'PositionID';

    public function __construct()
    {
        parent::__construct($this->model, $this->fields, $this->idFeild);
    }



    // public function getAll(Request $request)
    // {
    //     if ($request->input()) {

    //         return $this->getOne($request);
    //     }

    //     $data = $this->model::get();

    //     return $this->response(true, $data);
    // }
    // public function getOne(Request $request)
    // {
    //     $id = $request->input($this->idFeild);
    //     $data = $this->model::find($id);

    //     return $this->response(true, $data);
    // }

    // public function create(Request $request)
    // {

    //     try {

    //         $inputList = $this->createInputList($request);
    //         $data = $this->model::create($inputList);

    //         return $this->response(true, $data);
    //     } catch (\Throwable $th) {
    //         return $this->response(false, $th);
    //     }

    // }

    // public function update(Request $request)
    // {

    //     try {

    //         $id = $request->input($this->idFeild);
    //         $inputList = $this->createInputList($request);

    //         $data = $this->model::find($id);

    //         $data->update($inputList);

    //         return $this->response(true, $data);

    //     } catch (\Throwable $th) {
    //         return $this->response(false, $th);
    //     }

    // }

    // public function delete(Request $request)
    // {

    //     try {

    //         $id = $request->input($this->idFeild);
    //         $data = $this->model::find($id);
    //         $data->delete();

    //         return $this->response(true, $data);

    //     } catch (\Throwable $th) {
    //         return $this->response(false, $th);
    //     }

    // }

    // protected function response($success, $data)
    // {
    //     return response()->json([
    //         'success' => $success,
    //         'data' => $data
    //     ]);
    // }

    // protected function createInputList(Request $request)
    // {
    //     $resultList = [];
    //     for ($i = 0; $i < count($this->fields); $i++) {
    //         $columnName = $this->fields[$i];
    //         $resultList[$columnName] = $request->input($this->fields[$i]);
    //     }
    //     return $resultList;
    // }

}
