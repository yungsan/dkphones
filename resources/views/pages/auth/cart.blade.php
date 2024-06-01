@extends('layout')

@section('title', 'App - Top Page')


@section('content')
<div class="main-content lg:px-48 px-4">
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
      <div class="flex items-center my-4">
        <h1 class="opacity-60 mr-4">Số lượng: </h1>
        <div class="w-12 h-12 border rounded-s-full border-primary-300 flex items-center justify-center  text-2xl"
        onclick="javascript:(function() { updateCart({{$p['CartID']}}, {{$p['Quantity']}} - 1); })()" id="decrease">
        -
        </div>
        <div
        class="w-16 h-12 border border-x-0 bg-primary-400 border-primary-300 flex items-center justify-center text-white text-xl"
        id="quantity">
        {{$p['Quantity']}}
        </div>
        <div class="w-12 h-12 border rounded-e-full border-primary-300 flex items-center justify-center  text-2xl"
        onclick="javascript:(function() {  updateCart({{$p['CartID']}}, {{$p['Quantity']}} + 1); })()"
        id="increase">+
        </div>
      </div>
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
      <button class="bg-primary-500 px-4 py-4 text-white lg:w-1/3 w-full rounded-full">Tiến hành đặt hàng</button>
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

  <script>
    const i = document.querySelector('#increase');
    const d = document.querySelector('#decrease');
    const q = document.querySelector('#quantity');
    const r = document.querySelector('#remain');

    function increase() {

    }
    // i.addEventListener('click', () => {
    //   const v = Number(q.innerHTML);
    //   q.innerHTML = v + 1;
    //   updateCart({{$p['CartID']}}, v+1)
    // });

    // d.addEventListener('click', () => {
    //   const v = Number(q.innerHTML);
    //   if (v <= 1) return;
    //   q.innerHTML = v - 1;
    //   updateCart({{$p['CartID']}}, v-1)
    // });

    function updateCart(id, quantity) {
      $.ajax({
        url: '{{ route('updateCart') }}',
        type: 'PUT',
        dataType: "json",
        data: {
          CartID: id,
          Quantity: quantity
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