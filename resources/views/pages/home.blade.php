@extends('layout')

@section('title', 'App - Top Page')

@section('breadcrumb')
@include('partial.breadcrumb')
@stop

<div class="mt-24">
  @section('content')
  <div class="main-content px-40">
    <div class="border-b pb-6 pt-8 flex justify-between">
      <h1 class="font-bold text-3xl uppercase px-4">Sản phẩm mới</h1>
      <nav class="px-4">
        <span class="text-primary-500 px-4">All</span>
        <span class="opacity-60 px-4">New</span>
        <span class="opacity-60 px-4">Featured</span>
        <span class="opacity-60 px-4">Offer</span>
      </nav>
    </div>
    <div class="flex flex-wrap justify-between items-start my-8 gap-y-4">

      @foreach($products as $p)
    <a href="/product/{{$p['ProductID']}}" class="w-1/4 px-4">
      <div class="w-full h-72  rounded-lg bg-white">
      <img src="{{$p['ImageURL']}}" alt="thumb" class="w-full h-full object-cover">
      </div>
      <h3 class="w-full text-center font-semibold text-xl my-4">{{$p['ProductName']}}</h3>
      <h3 class="w-full text-center text-md font-semibold text-primary-500 ">{{number_format($p['Price'])}} đ</h3>
    </a>
  @endforeach
    </div>
    <div class="border-b pb-6 pt-8 flex justify-between">
      <h1 class="font-bold text-3xl uppercase px-4">Sản phẩm nổi bật</h1>
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
      <h3 class="w-full text-center text-md font-semibold text-primary-500 ">{{number_format($p['Price'])}} đ</h3>
    </a>
  @endforeach
    </div>

    <div class="flex flex-wrap px-12 my-8 justify-between text-center">
      <div class="w-1/3 px-8">
        <div class="w-full text-center flex justify-center">
          <x-iconsax-bro-box class="w-16 h-16" />
        </div>
        <h1 class="font-bold my-4 text-lg">Miễn Phí Vận Chuyển</h1>
        <p class="opacity-65">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis vero aliquam</p>
      </div>
      <div class="w-1/3 px-8">
        <div class="w-full text-center flex justify-center">
          <x-iconsax-bro-lock-circle class="w-16 h-16" />
        </div>
        <h1 class="font-bold my-4 text-lg">Thanh Toán An Toàn</h1>
        <p class="opacity-65">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis vero aliquam</p>
      </div>
      <div class="w-1/3 px-8">
        <div class="w-full text-center flex justify-center">
          <x-iconsax-bro-refresh class="w-16 h-16" />
        </div>
        <h1 class="font-bold my-4 text-lg">Hoàn Trả Miễn Phí</h1>
        <p class="opacity-65">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis vero aliquam</p>
      </div>
    </div>
    <div class="border-b pb-6 pt-8 flex justify-between">
      <h1 class="font-bold text-3xl uppercase px-4">Samsung galaxy</h1>
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
      <h3 class="w-full text-center text-md font-semibold text-primary-500 ">{{number_format($p['Price'])}} đ</h3>
    </a>
  @endforeach
    </div>

    <div class="border-b pb-6 pt-8 flex justify-between">
      <h1 class="font-bold text-3xl uppercase px-4">iPhone</h1>
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
      <h3 class="w-full text-center text-md font-semibold text-primary-500 ">{{number_format($p['Price'])}} đ</h3>
    </a>
  @endforeach
    </div>

    @stop
  </div>