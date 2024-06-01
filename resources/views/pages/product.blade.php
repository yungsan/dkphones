@extends('layout')

@section('title', 'App - Top Page')


@section('content')
<div class="main-content lg:px-40 mt-24">
  <div class="border-b pb-6 pt-8 flex flex-wrap justify-between">
    <h1 class="font-bold lg:text-3xl text-2xl uppercase px-4">Tất cả sản phẩm</h1>
    <nav class="lg:px-4 lg:mt-0 mt-2">
      <span class="text-primary-500 px-4">All</span>
      <span class="opacity-60 px-4">New</span>
      <span class="opacity-60 px-4">Featured</span>
      <span class="opacity-60 px-4">Offer</span>
    </nav>
  </div>
  <div class="flex flex-wrap justify-between items-start my-8">

    @foreach($products as $p)
    <a href="/product/{{$p['ProductID']}}" class="lg:w-1/5 w-full px-4">
      <div class="lg:w-full lg:h-60 h-40 w-40 rounded-lg bg-white m-auto">
      <img src="{{$p['ImageURL']}}" alt="thumb" class="w-full h-full object-cover">
      </div>
      <h3 class="w-full text-center font-semibold text-xl my-4">{{$p['ProductName']}}</h3>
      <h3 class="w-full text-center text-lg font-bold text-primary-500 ">{{number_format($p['Price'])}} đ</h3>
    </a>
  @endforeach
  </div>
</div>

@stop