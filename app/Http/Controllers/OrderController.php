<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends BaseController
{
    private $model = Order::class;
    private $fields = [
        'OrderID',
        'Total',
        'StatusID',
        'CustomerID',
        'EmployeeID',
        'ShipperID',
        'DeliveryAt',
        'DeliveryResultAt',
    ];
    private $idFeild = 'OrderID';
    public function __construct()
    {
        parent::__construct($this->model, $this->fields, $this->idFeild);
    }

    public function index()
    {
        $Products = Session::get('Products');
        $CustomerID = Session::get('CustomerID');
        $Total = Session::get('Total');
        $Address = Session::get('Address');
        return view('pages/auth/checkout', [
            'Products' => $Products,
            'CustomerID' => $CustomerID,
            'Total' => $Total,
            'Address' => $Address,
        ]);

    }

    #[\Override]
    public function getAll(Request $request)
    {
        $did = auth()->user()['DepartmentID'];
        if ($request->input($this->idFeild)) {
            return $this->getOne($request);
        }
        $orders = Order::leftJoin('statuses', 'statuses.StatusID', '=', 'orders.StatusID')
            ->leftJoin('customers', 'customers.CustomerID', '=', 'orders.CustomerID')
            ->leftJoin('order_details', 'order_details.OrderID', '=', 'orders.OrderID')
            ->join('products', 'products.ProductID', '=', 'order_details.ProductID')
            ->join('batches', 'batches.SKU', '=', 'products.SKU')
            ->select(
                'orders.*',
                'statuses.StatusName',
                DB::raw('COUNT(order_details.ProductID) as ProductCount'),
                'customers.CustomerName',
                'products.ProductName',
                'order_details.Quantity as Quantity',
                DB::raw('SUM(batches.Quantity) as Remain')
            );
        if ($did === 1) {
            $orders = $orders->where('statuses.StatusName', '=', 'Giao hàng thành công');
        } else if ($did === 4) {
            $orders = $orders->where('statuses.StatusName', '=', 'Sẵn sàng giao hàng');
        } else if ($did === 3) {
            $orders = $orders->where('statuses.StatusName', '=', 'Chờ xác nhận');
        }

        $orders = $orders
            ->groupBy('orders.OrderID', 'products.SKU', 'order_details.Quantity')
            ->orderBy('orders.OrderID', 'desc')
            ->orderBy('orders.CreatedAt', 'desc')
            ->orderBy('orders.StatusID')
            ->get();

        return $this->response(true, $orders);
    }

    #[\Override]
    public function getOne(Request $request)
    {
        $orders = Order::select('orders.*', 'statuses.StatusName', DB::raw('COUNT(order_details.ProductID) AS ProductCount'), 'customers.CustomerName')
            ->leftJoin('statuses', 'statuses.StatusID', '=', 'orders.StatusID')
            ->leftJoin('customers', 'customers.CustomerID', '=', 'orders.CustomerID')
            ->leftJoin('order_details', 'order_details.OrderID', '=', 'orders.OrderID')
            ->groupBy('orders.OrderID')
            ->find($request->input($this->idFeild));
        return $this->response(true, $orders);
    }


    #[\Override]
    public function update(Request $request)
    {
        try {

            $id = $request->input($this->idFeild);

            $data = $this->model::find($id);
            $inputList = $this->createInputList($request);

            $data->update($inputList);

            return $this->response(true, $data);

        } catch (\Throwable $th) {
            return $this->response(false, $th);
        }
    }

    #[\Override]
    protected function createInputList(Request $request)
    {
        $resultList = [];
        for ($i = 0; $i < count($this->fields); $i++) {
            $columnName = $this->fields[$i];
            $value = $request->input($this->fields[$i]);
            if ($value) {
                $resultList[$columnName] = $value;
            }
        }
        return $resultList;
    }

    #[\Override]
    public function create(Request $request)
    {
        try {
            $id = time();
            $order = Order::create(
                [
                    'OrderID' => $id,
                    'Total' => $request->input('Total'),
                    'StatusID' => 1,
                    'Address' => $request->input('Address'),
                    'CustomerID' => $request->input('CustomerID'),
                ]
            );


            $details = [];
            $productList = $request->input('ProductList');
            for ($i = 0; $i < count($productList); $i++) {
                array_push($details, [
                    'OrderID' => $id,
                    'ProductID' => $productList[$i]['ProductID'],
                    'Quantity' => $productList[$i]['Quantity'],
                ]);
            }
            OrderDetail::insert($details);
            return 'Đặt hàng thành công!';
        } catch (\Throwable $th) {
            return 'Lỗi';
        }


    }

    public function dasboard()
    {
        $dateOneDaysAgo = Carbon::now()->subDays(1)->toDateString();

        $allTime = DB::select("
            SELECT SUM(o.Total) as Total,
                SUM(b.Price * b.Quantity) as Cost,
                SUM(o.Total) - SUM(b.Price * b.Quantity) as Profit
            FROM orders o
                join order_details d on d.OrderID = o.OrderID
                join statuses s on s.StatusID = o.StatusID 
                join received_notes r join batches b on b.BatcheID = r.BatcheID
            WHERE s.StatusName = 'Giao hàng thành công'
        ")[0];


        return $this->response(true, $allTime);
    }

    public function orderDetail($id)
    {
        $orders = Order::select('orders.OrderID', 'ProductName', 'Price', 'Quantity')
            ->leftJoin('order_details', 'order_details.OrderID', '=', 'orders.OrderID')
            ->leftJoin('products', 'products.ProductID', '=', 'order_details.ProductID')
            ->where('orders.OrderID', $id)
            ->get();
        return view('pages/auth/order', ['oders' => $orders]);
    }

    public function cancelOrder(Request $request)
    {
        $order = Order::find($request->input('OrderID'));
        $status = Status::where('StatusName', 'Đã huỷ đơn')->first();
        $order->StatusID = $status['StatusID'];
        $order->save();
        return $order;
    }
}
