@extends('layout')

@section('title', 'App - Top Page')

@section('breadcrumb')
@include('partial.breadcrumb')
@stop

@section('content')
<div class="main-content px-40 mt-24">
  <div class="border-b pb-6 pt-8 flex justify-between">
    <h1 class="font-bold text-3xl uppercase px-4">Tất cả sản phẩm</h1>
    <nav class="px-4">
      <span class="text-primary-500 px-4">All</span>
      <span class="opacity-60 px-4">New</span>
      <span class="opacity-60 px-4">Featured</span>
      <span class="opacity-60 px-4">Offer</span>
    </nav>
  </div>
  <div class="flex flex-wrap justify-between items-start my-8">

    @foreach($products as $p)
    <a href="/product/{{$p['ProductID']}}" class="w-1/4 px-4">
    <div class="w-full h-72  rounded-lg bg-white">
      <img src="{{$p['ImageURL']}}" alt="thumb" class="w-full h-full object-cover">
    </div>
    <h3 class="w-full text-center font-semibold text-xl my-4">{{$p['ProductName']}}</h3>
    <h3 class="w-full text-center text-md ">{{number_format($p['Price'])}} đ</h3>
    </a>
  @endforeach
  </div>
</div>

@stop