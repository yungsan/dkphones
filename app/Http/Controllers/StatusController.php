<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends BaseController
{

    private $model = Status::class;
    private $fields = ['StatusName'];
    private $idFeild = 'StatusID';

    public function __construct()
    {
        parent::__construct($this->model, $this->fields, $this->idFeild);
    }

}
