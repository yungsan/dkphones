<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
  private $model;
  private $fields;
  private $idFeild;

  public function __construct($model, $fields, $idFeild)
  {
    $this->model = $model;
    $this->fields = $fields;
    $this->idFeild = $idFeild;
  }

  public function getAll(Request $request)
  {
    if ($request->input($this->idFeild)) {

      return $this->getOne($request);
    }

    $data = $this->model::get();

    return $this->response(true, $data);
  }
  public function getOne(Request $request)
  {
    $id = $request->input($this->idFeild);
    $data = $this->model::find($id);

    return $this->response(true, $data);
  }


  public function create(Request $request)
  {
    try {

      $inputList = $this->createInputList($request);
      $data = $this->model::create($inputList);

      return $this->response(true, $data);
    } catch (\Throwable $th) {
      return $this->response(false, $th);
    }

  }

  public function update(Request $request)
  {
    try {

      $id = $request->input($this->idFeild);
      $inputList = $this->createInputList($request);

      $data = $this->model::find($id);

      $data->update($inputList);

      return $this->response(true, $data);

    } catch (\Throwable $th) {
      return $this->response(false, $th);
    }

  }

  public function delete(Request $request)
  {

    try {

      $id = $request->input($this->idFeild);
      $data = $this->model::find($id);
      $data->delete();

      return $this->response(true, $data);

    } catch (\Throwable $th) {
      return $this->response(false, $th);
    }

  }

  protected function response($success, $data)
  {
    return response()->json([
      'success' => $success,
      'data' => $data
    ]);
  }

  protected function createInputList(Request $request)
  {
    $resultList = [];
    for ($i = 0; $i < count($this->fields); $i++) {
      $columnName = $this->fields[$i];
      $resultList[$columnName] = $request->input($this->fields[$i]);
    }
    return $resultList;
  }
}
