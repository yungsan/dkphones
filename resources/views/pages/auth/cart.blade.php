@extends('layout')

@section('title', 'App - Top Page')

@section('breadcrumb')
@include('partial.breadcrumb')
@stop

@section('content')
<div class="main-content px-48">
  <div class="flex flex-wrap justify-between mt-24 border-b pb-8">
    @foreach($carts as $p)

    <div class="flex flex-wrap justify-between w-full items-center my-4">
    <div class="w-24 h-24">
      <img src="{{$p['ImageURL']}}" alt="asd" class="w-full h-full">
      <button onclick="deleteCart({{$p['CartID']}})" class="text-red-500 text-center w-full">Xoá</button>
    </div>
    <div class="flex-1 ml-4">
      <h1 class="font-bold uppercase">{{$p['ProductName']}}</h1>
      <h1 class="font-semibold text-primary-400 text-sm my-2">{{$p['SKU']}}</h1>
      <h1 class="opacity-60 flex">
      <span class="w-20">
        Số lượng:
      </span>
      <span>
        {{$p['Quantity']}}
      </span>
      </h1>
      <h1 class="flex">
      <span class="opacity-60 w-20">Đơn giá</span>
      <span class="font-bold text-primary-600">{{number_format($p['Price'])}} đ</span>
      </h1>
    </div>
    </div>
  @endforeach
  </div>

  <div class="w-full text-center mt-4">
    <form action="/buyNow" method="post">
      @csrf
      <button class="bg-primary-500 px-4 py-4 text-white w-1/3 rounded-full">Tiến hành đặt hàng</button>
    </form>
  </div>
  <script>
    function deleteCart(id) {
      $.ajax({
        url: '{{ route('deleteCart') }}',
        type: 'DELETE',
        dataType: "json",
        data: {
          CartID: id,
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
      location.reload();
    }
  </script>
  @stop