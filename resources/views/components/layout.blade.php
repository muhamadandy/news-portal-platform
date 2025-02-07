<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}</title>
    <link rel="icon" href="{{ asset('images/Picture1.png') }}" type="image/x-icon">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
    @vite('resources/css/app.css')
</head>
<body class="font-sans min-h-screen flex flex-col">
    <header class=" bg-black shadow-md">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold text-red-500">
                <img src="{{ asset('images/nav-banner-logo.png') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}" class=" size-16 w-auto">
            </a>



            <!-- Links -->
            @guest
            <div class="flex items-center space-x-4">
                <a href="{{ route('register') }}" class=" text-white hover:text-blue-600 text-lg font-semibold">Daftar Akun</a>
                <a href="{{ route('login') }}" class=" text-white hover:text-blue-600 text-lg font-semibold">Masuk Akun</a>
            </div>
            @endguest

            @auth
            <div class="flex items-center space-x-4">
                <div>
                    <a href="{{route('profile.edit')}}" class="text-lg  text-white font-semibold">{{ auth()->user()->name }}</a>
                </div>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="text-red-500 font-semibold text-lg">Keluar</button>
                </form>
            </div>
            @endauth
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8 flex-grow">
        {{$slot}}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 text-center py-4">
        <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} {{ env('APP_NAME') }}</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 3000,
        },
        spaceBetween: 10, // Menambahkan ruang antar slide jika diperlukan
        slidesPerView: 1, // Pastikan hanya satu slide yang ditampilkan
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
});
</script>


</body>

</html>
