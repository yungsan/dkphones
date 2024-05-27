@extends('layout')

@section('title', 'App - Top Page')

@section('breadcrumb')
@include('partial.breadcrumb')
@stop

@section('content')
<div class="main-content px-24">
  <div class="flex justify-between mt-24">
    <div class="w-1/2 min-h-96 bg-white-500 mr-8">
      <img src="{{$product['ImageURL']}}" alt="img" class="w-full h-full object-cover">
    </div>
    <div class="w-2/3">
      <p class="font-semibold text-primary-600">{{$product['SKU']}}</p>
      <h1 class="font-bold text-2xl uppercase my-4">{{$product['ProductName']}}</h1>
      <div class="flex items-end my-4">
        <h1 class="opacity-60 mr-4">Đơn giá: </h1>
        <h1 class="font-bold text-xl text-primary-500">{{number_format($product['Price'])}} đ</h1>
      </div>
      <div class="flex items-center my-4">
        <h1 class="opacity-60 mr-4">Số lượng: </h1>
        <div class="w-12 h-12 border rounded-s-full border-primary-300 flex items-center justify-center  text-2xl"
          id="decrease">-
        </div>
        <div
          class="w-16 h-12 border border-x-0 bg-primary-400 border-primary-300 flex items-center justify-center text-white text-xl"
          id="quantity">1</div>
        <div class="w-12 h-12 border rounded-e-full border-primary-300 flex items-center justify-center  text-2xl"
          id="increase">+
        </div>
        <h1 class="opacity-60 ml-4">
          <span id="remain">{{$product['Remain']}}</span>
          sản phẩm có sẵn
        </h1>
      </div>
      <div class="h-52 w-full overflow-y-scroll flex flex-wrap gap-y-4">
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">Màu sắc</h1>
          </div>
          <p>{{$product['Color']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">Kích thước</h1>
          </div>
          <p>{{$product['Dimension']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">Cân nặng</h1>
          </div>
          <p>{{$product['Weight']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">Màn hình</h1>
          </div>
          <p>{{$product['ScreenSize']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">Độ phân giải</h1>
          </div>
          <p>{{$product['ScreenResolution']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">Camera trước</h1>
          </div>
          <p>{{$product['FrontCamera']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">Camera sau</h1>
          </div>
          <p>{{$product['RearCamera']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">CPU</h1>
          </div>
          <p>{{$product['CPU']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">RAM</h1>
          </div>
          <p>{{$product['RAM']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">Dung lượng Pin</h1>
          </div>
          <p>{{$product['Power']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">Cổng sạc</h1>
          </div>
          <p>{{$product['ChargingPort']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">SIM</h1>
          </div>
          <p>{{$product['SIM']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">Bluetooth</h1>
          </div>
          <p>{{$product['Bluetooth']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">Jack tai nghe</h1>
          </div>
          <p>{{$product['HeadphoneJack']}}</p>
        </div>
        <div class="flex items-center w-full">
          <div class="w-1/5">
            <h1 class="font-bold">Dung lượng</h1>
          </div>
          <p>{{$product['Storage']}}</p>
        </div>
      </div>
      <div class="flex items-center my-4 gap-x-4">
        <button id="buyNow" class="bg-primary-500 px-4 py-4 text-white w-1/3 rounded-full">Mua ngay</button>
        <button id="addCart"
          class="bg-white border border-primary-500 px-4 py-4 text-primary-500 w-2/3 rounded-full">Thêm vào giỏ
          hàng</button>
      </div>
    </div>
  </div>
  <form action="/buyNow" method="post" id="buyNowForm">
    @csrf
    <input type="text" name="ProductID" value="{{$product['ProductID']}}">
    <input type="text" name="Quantity" value="1" id="q_inp">
  </form>
</div>

<script>
  const i = document.querySelector('#increase');
  const d = document.querySelector('#decrease');
  const q = document.querySelector('#quantity');
  const r = document.querySelector('#remain');

  i.addEventListener('click', () => {
    const v = Number(q.innerHTML);
    const rv = Number(r.innerHTML);
    if (v >= rv) return;
    q.innerHTML = v + 1;
    document.querySelector('#q_inp').value = q.innerHTML;
  });

  d.addEventListener('click', () => {
    const v = Number(q.innerHTML);
    if (v <= 1) return;
    q.innerHTML = v - 1;
    document.querySelector('#q_inp').value = q.innerHTML;

  });

</script>

<script type="text/javascript">
  const bn = document.querySelector('#buyNow');
  const ac = document.querySelector('#addCart');
  const f = document.querySelector('#buyNowForm');

  bn.addEventListener('click', () => {
    console.log('cacsaduasj');
    if (token) {
      f.submit();
    }
    else {
      window.location.href = '/login';
    }
  });

  ac.addEventListener('click', () => {
    if (!token) {
      window.location.href = '/login';
      return;
    }
    $.ajax({
      url: '{{ route('addToCart') }}',
      type: 'POST',
      dataType: "json",
      data: {
        ProductID: {{$product['ProductID']}},
        Quantity: document.querySelector('#q_inp').value
      },
      complete: function (r) {
        console.log(r);
      },
      error: (e) => {
        console.log(e);
      }
    }).done((r) => {
      console.log(r);
    });
    alert('Đã thêm vào giỏ hàng');
  });
</script>
@stop