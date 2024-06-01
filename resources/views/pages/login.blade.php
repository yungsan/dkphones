@extends('layout')

@section('title', 'App - Top Page')

@section('content')
<div class="main-content lg:px-24 px-4">
  <div class="flex justify-between mt-24">
    <form action="/login" method="post" class="lg:w-1/2 w-full m-auto">
      @csrf <!-- {{ csrf_field() }} -->

      <h1 class="font-extrabold text-primary-500 uppercase w-full text-center text-3xl">Đăng nhập</h1>
      <div class="my-4">
        <label for="PhoneNumber" class="font-bold">Số điện thoại</label>
        <input type="text" name="PhoneNumber" id="PhoneNumber" placeholder="Số điện thoại của bạn"
          class="block w-full border p-4 rounded-lg my-2">
      </div>
      <div class="my-4">
        <label for="Password" class="font-bold">Mật khẩu</label>
        <input type="password" name="Password" id="Password" placeholder="Mật khẩu"
          class="block w-full border p-4 rounded-lg my-2">
      </div>
      <div class="flex justify-between w-full">
        <a href="#" class="text-primary-500">Quên mật khẩu</a>
        <a href="/register" class="text-primary-500">Chưa có tài khoản? Đăng ký</a>
      </div>
      <button type="submit" class="bg-primary-500 text-white  px-4 py-4 mt-4 w-full rounded-full font-bold">Đăng
        nhập</button>
    </form>
  </div>
</div>

@stop