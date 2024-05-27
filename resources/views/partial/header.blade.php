<div class="w-full bg-white shadow h-24 flex items-center justify-between px-16 fixed top-0 left-0 z-50">
  <div class="">
    <a href="/" class="font-extrabold text-2xl">
      <span class="text-primary-500">DK</span>
      <span class="font-light">Phones</span>
    </a>
  </div>
  <div class="w-1/2 ">
    <nav class="flex justify-center">
      <a href="/" class="px-4">Trang chủ</a>
      <a href="/product" class="px-4">Sản phẩm</a>
      <a href="#" class="px-4">Blog</a>
      <a href="#" class="px-4">Khuyến mãi</a>
      <a href="#" class="px-4">Liên hệ</a>
    </nav>
  </div>
  <div class="flex gap-x-4 h-10 flex-1">
    <form action="/search" method="get">
      <div class="relative">
        <input type="text" name="keyword" class="border py-2 px-4 rounded-full ">
        <div class="w-12 h-full rounded-full absolute top-1/2 right-0 -translate-y-1/2 p-2">
          <x-iconsax-out-search-normal-1 class="p-1 h-full" />
        </div>
      </div>
    </form>
    <div class="flex justify-center gap-x-6">
      <div class="h-10 w-10 border rounded-full">
        <x-iconsax-bro-heart class="p-2 h-full" />
      </div>
      <a href="/cart" class="h-10 w-10 border rounded-full">
        <x-iconsax-bol-shopping-bag class="p-2 h-full" />
      </a>
      @if (Cookie::get('jwt_token'))
    <a href="/profile" class="h-10 w-10 border rounded-full">
      <x-iconsax-lin-user class="p-2 h-full" />
    </a>
  @endif
    </div>
    @if (!Cookie::get('jwt_token'))
    <a href="/login" class="bg-primary-600 text-white rounded-full px-4 py-2 font-semibold">Đăng nhập</a>
  @endif
  </div>
</div>