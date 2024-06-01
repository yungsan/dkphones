@extends('layout')

@section('title', 'App - Top Page')


@section('content')
<div class="main-content lg:px-48 px-4">
  <div class="flex flex-wrap justify-between mt-24 border-b pb-8">
    @foreach($Products as $p)

    <div class="flex flex-wrap justify-between w-full items-center">
      <div class="w-16 h-16">
      <img src="{{$p['ImageURL']}}" alt="asd" class="w-full h-full">
      </div>
      <div class="flex-1 ml-4">
      <h1 class="font-bold uppercase">{{$p['ProductName']}}</h1>
      <h1 class="font-semibold text-primary-400 text-sm my-2">{{$p['SKU']}}</h1>
      <h1 class="font-bold text-primary-600">
        {{number_format($p['Total'])}} đ
      </h1>
      </div>
    </div>
  @endforeach
  </div>
  <div class="flex justify-between items-center my-8">
    <h1 class="font-extralight text-2xl uppercase">Tổng cộng:</h1>
    <h1 class="font-bold text-primary-600 text-xl">{{number_format($Total)}} đ</h1>
  </div>
  <div class="w-full text-center">
    <input type="text" name="shippingAddress" id="shippingAddress" placeholder="Địa chỉ giao hàng" value="{{$Address}}"
      class="border w-full p-4 my-4 border-primary-500 rounded-full">
    <button id="checkout" class="bg-primary-500 px-4 py-4 text-white lg:w-1/3 w-full rounded-full">Xác nhận đặt
      hàng</button>
  </div>
  <script>
    const ck = document.querySelector('#checkout');
    ck.addEventListener('click', () => {
      if (document.querySelector('#shippingAddress').value.trim().length === 0) {
        alert('Nhập địa chỉ');
        return;
      }
      $.ajax({
        url: '{{ route('checkout') }}',
        type: 'POST',
        dataType: "json",
        data: {
          CustomerID: {{$CustomerID}},
          Total: {{$Total}},
          Address: document.querySelector('#shippingAddress').value,
          ProductList: {!! json_encode($Products) !!}
        },
        complete: function (r) {
          console.log(r);
          window.location.href = '/profile';
        },
        error: (e) => {
          console.log(e);
        }
      }).done(r => {
        console.log(r);
      });
    });

  </script>
  @stop