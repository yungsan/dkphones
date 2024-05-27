@extends('layout')

@section('title', 'App - Top Page')

@section('breadcrumb')
@include('partial.breadcrumb')
@stop

@section('content')
<div class="main-content px-24">
  <div class="flex justify-between mt-24">
    <form action="/register" method="post" class="w-1/2 m-auto">
      @csrf <!-- {{ csrf_field() }} -->
      <h1 class="font-extrabold text-primary-500 uppercase w-full text-center text-3xl">Đăng ký</h1>
      <div class="my-4">
        <label for="PhoneNumber" class="font-bold">Số điện thoại</label>
        <input type="text" name="PhoneNumber" id="PhoneNumber" placeholder="Số điện thoại của bạn"
          class="block w-full border p-4 rounded-lg my-2">
      </div>
      <div class="my-4">
        <label for="CustomerName" class="font-bold">Họ và tên</label>
        <input type="text" name="CustomerName" id="CustomerName" placeholder="Họ và tên của bạn"
          class="block w-full border p-4 rounded-lg my-2">
      </div>
      <div class="my-4 flex items-center gap-x-4">
        <input type="radio" name="Gender" id="m" class="block  border p-4 rounded-lg my-2" value="0">
        <label for="m" class="font-bold">Nam</label>
      </div>
      <div class="my-4 flex items-center gap-x-4">
        <input type="radio" name="Gender" id="f" class="block  border p-4 rounded-lg my-2" value="1">
        <label for="f" class="font-bold">Nữ</label>
      </div>
      <div class="my-4">
        <label for="Password" class="font-bold">Mật khẩu</label>
        <input type="password" name="Password" id="Password" placeholder="Mật khẩu"
          class="block w-full border p-4 rounded-lg my-2">
      </div>
      <div class="flex justify-between w-full">
        <a href="/login" class="text-primary-500 w-full text-right">Đã có tài khoản? Đăng nhập</a>
      </div>
      <button type="submit" class="bg-primary-500 text-white  px-4 py-4 mt-4 w-full rounded-full font-bold">Đăng
        ký</button>
    </form>
  </div>
</div>

@stop