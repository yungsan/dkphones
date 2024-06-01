@extends('layout')

@section('title', 'App - Top Page')


<div class="mt-24">
  @section('content')
  <div class="main-content lg:px-40 ">
    <div class="border-b pb-6 pt-8 flex flex-wrap justify-between">
      <h1 class="font-bold lg:text-3xl text-2xl uppercase px-4">Sản phẩm mới</h1>
      <nav class="lg:px-4 lg:mt-0 mt-2">
        <span class="text-primary-500 px-4">All</span>
        <span class="opacity-60 px-4">New</span>
        <span class="opacity-60 px-4">Featured</span>
        <span class="opacity-60 px-4">Offer</span>
      </nav>
    </div>
    <div class="flex flex-wrap justify-between items-start my-8 gap-y-4">

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
    <div class="border-b pb-6 pt-8 flex justify-between">
      <h1 class="font-bold lg:text-3xl text-2xl uppercase px-4">Sản phẩm nổi bật</h1>
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

    <div class="flex flex-wrap px-12 my-8 justify-between text-center">
      <div class="lg:w-1/3 w-full px-8">
        <div class="w-full text-center flex justify-center">
          <x-iconsax-bro-box class="w-16 h-16" />
        </div>
        <h1 class="font-bold my-4 text-lg">Miễn Phí Vận Chuyển</h1>
        <p class="opacity-65">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis vero aliquam</p>
      </div>
      <div class="lg:w-1/3 w-full px-8 my-4 lg:my-0">
        <div class="w-full text-center flex justify-center">
          <x-iconsax-bro-lock-circle class="w-16 h-16" />
        </div>
        <h1 class="font-bold my-4 text-lg">Thanh Toán An Toàn</h1>
        <p class="opacity-65">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis vero aliquam</p>
      </div>
      <div class="lg:w-1/3 w-full px-8">
        <div class="w-full text-center flex justify-center">
          <x-iconsax-bro-refresh class="w-16 h-16" />
        </div>
        <h1 class="font-bold my-4 text-lg">Hoàn Trả Miễn Phí</h1>
        <p class="opacity-65">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis vero aliquam</p>
      </div>
    </div>
    <div class="border-b pb-6 pt-8 flex justify-between">
      <h1 class="font-bold lg:text-3xl text-2xl uppercase px-4">Samsung galaxy</h1>
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

    <div class="border-b pb-6 pt-8 flex justify-between">
      <h1 class="font-bold lg:text-3xl text-2xl uppercase px-4">iPhone</h1>
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

    @stop
  </div>