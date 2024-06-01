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

    // #[\Override]
    // public function getOne(Request $request)
    // {
    //     $did = auth()->user()['DepartmentID'];
    //     $data = null;
    //     if ($did === 3) {
    //         $data = Status::whereIn('StatusName', ['Chờ xác nhận', 'Xác nhận đặt hàng', 'Đang nhập hàng', 'Đã huỷ đơn', 'Sẵn sàng giao hàng']);
    //     }
    //     if ($did === 4) {
    //         $data = Status::whereIn('StatusName', ['Đang giao hàng', 'Giao hàng thành công', 'Giao hàng thất bại']);
    //     }
    //     return $this->response(true, $data->get());
    // }

}
