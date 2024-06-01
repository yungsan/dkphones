@extends('layout')

@section('title', 'App - Top Page')


@section('content')
<div class="main-content lg:px-24 px-4">
  <div class="flex justify-between mt-24">
    <div class="w-full">
      <table class="w-full whitespace-nowrap table-auto overflow-x-scroll">
        <tr>
          <th class="border-b py-2">Mã hoá đơn</th>
          <th class="border-b py-2">Tên sản phẩm</th>
          <th class="border-b py-2">Đơn giá</th>
          <th class="border-b py-2">Số lượng</th>
        </tr>
        @foreach ($oders as $o)
      <tr>
        <td class="border-b py-4 text-center">
        <h1 class="font-bold underline">
          {{$o['OrderID']}}
        </h1>
        </td>
        <td class="border-b py-4 text-center">{{$o['ProductName']}}</td>
        <td class="border-b py-4 text-center font-bold">
        {{number_format($o['Price'])}} đ
        </td>
        <td class="border-b py-4 text-center font-bold">
        {{$o['Quantity']}}
        </td>
      </tr>
    @endforeach


      </table>
    </div>
  </div>
  @stop