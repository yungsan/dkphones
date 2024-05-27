@extends('layout')

@section('title', 'App - Top Page')

@section('breadcrumb')
@include('partial.breadcrumb')
@stop

@section('content')
<div class="main-content px-24">
  <div class="flex justify-between mt-24">
    <div class="w-1/3 ">
      <div class="w-48 h-48 m-auto">
        <img
          src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=1744"
          alt="" class="w-full h-full object-cover rounded-full">
      </div>
      <div class="flex flex-wrap my-4 gap-y-4 px-12">
        <div class="w-full flex flex-wrap items-center justify-between">
          <div class="w-1/5">
            <x-iconsax-lin-user class="w-6 h-6" />
          </div>
          <div class="w-4/5">
            <input type="text" name="CustomerName" class="w-full font-bold uppercase"
              value="{{$user['CustomerName']}}" />
          </div>
        </div>
        <div class="w-full flex flex-wrap items-center justify-between">
          <div class="w-1/5">
            <x-iconsax-bro-call class="w-6 h-6" />
          </div>
          <div class="w-4/5">
            <input type="text" name="PhoneNumber" class="w-full font-bold uppercase" value="{{$user['PhoneNumber']}}" />
          </div>
        </div>
        <div class="w-full flex flex-wrap items-center justify-between">
          <div class="w-1/5">
            <x-iconsax-out-location class="w-6 h-6" />
          </div>
          <div class="flex-1">
            <input type="text" name="Address" class="w-full" value="{{$user['Address']}}"
              placeholder="Chưa có địa chỉ" />
          </div>
        </div>

        <button onclick="edit()" class="bg-primary-500 px-4 py-2 text-white w-full  rounded-full">Cập nhật thông
          tin</button>
      </div>

      <form action="/logout" method="post" class="w-full text-center">
        @csrf
        <button class="border border-red-500 px-4 py-2 text-red-500 bg-white w-full  rounded-full">Đăng xuất</button>
      </form>
    </div>
    <div class="w-2/3">
      <table class="w-full">
        <tr>
          <th class="border-b py-2">Mã hoá đơn</th>
          <th class="border-b py-2">Tổng tiền</th>
          <th class="border-b py-2">Số lượng sản phẩm</th>
          <th class="border-b py-2">Trạng thái</th>
        </tr>
        @foreach($orders as $o)
      <tr>
      <td class="border-b py-4 text-center">
        <a href="/order/{{$o['OrderID']}}" class="font-bold underline">
        {{$o['OrderID']}}
        </a>
      </td>
      <td class="border-b py-4 text-center">{{number_format($o['Total'])}}</td>
      <td class="border-b py-4 text-center">{{$o['ProductCount']}}</td>
      <td class="border-b py-4 text-center font-bold">
        @if ($o['StatusName'] === 'Chờ xác nhận')
      <div class="border border-yellow-400 bg-yellow-50 text-yellow-400 rounded-full py-2">
      {{$o['StatusName']}}
      </div>
    @elseif ($o['StatusName'] === 'Đang giao hàng')
    <div class="border border-orange-500 bg-orange-50 text-orange-500 rounded-full py-2">
    {{$o['StatusName']}}
    </div>
  @elseif ($o['StatusName'] === 'Xác nhận đặt hàng')
  <div class="border border-primary-500 bg-primary-50 text-primary-500 rounded-full py-2 ">
  {{$o['StatusName']}}
  </div>
@elseif ($o['StatusName'] === 'Giao hàng thành công')
  <div class="bg-green-400 rounded-full py-2">
  {{$o['StatusName']}}
  </div>
@else
  <div class="border border-red-500 bg-red-50 rounded-full py-2 text-red-500">
  {{$o['StatusName']}}
  </div>
@endif
      </td>
      <td class="border-b py-4 text-center font-bold">
        @if ($o['StatusName'] === 'Chờ xác nhận')
      <button class="text-red-500 underline" onclick="huy({{$o['OrderID']}})">Huỷ đặt hàng</button>
    @endif
      </td>
      </tr>
    @endforeach

      </table>
    </div>
  </div>
  <script>
    function huy(id) {
      $.ajax({
        url: '{{ route('aaa') }}',
        type: 'PUT',
        dataType: "json",
        data: {
          OrderID: id,
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
    function edit() {
      $.ajax({
        url: '{{ route('profile.update') }}',
        type: 'PUT',
        dataType: "json",
        data: {
          CustomerName: document.querySelector('input[name="CustomerName"]').value,
          Address: document.querySelector('input[name="Address"]').value,
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