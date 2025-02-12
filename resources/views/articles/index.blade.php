<x-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        @if ($highlightedArticles->isNotEmpty())
            <div class="mb-12">
                <div class="relative w-full">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($highlightedArticles as $highlight)
                                <div class="swiper-slide">
                                    <div class="relative bg-gray-100 rounded-lg shadow-md overflow-hidden">
                                        <a href="{{ route('articles.show', $highlight->slug) }}">
                                            <img src="{{ Storage::disk('cloudinary')->url($highlight->image) }}"
                                                 alt="{{ $highlight->title }}"
                                                 class="w-full h-64 object-cover">
                                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-end p-6">
                                                <div class="md:max-w-[50%]">
                                                    <h2 class="text-2xl font-bold text-white mb-2">{{ $highlight->title }}</h2>
                                                    <p class="text-sm text-gray-200 mb-2">
                                                    {!! Str::limit(strip_tags($highlight->content), 100) !!}
                                                    </p>
                                                    <span class="text-sm text-white font-semibold bg-yellow-500 p-1 rounded-md">{{ $highlight->category->name }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next text-white"></div>
                        <div class="swiper-button-prev text-white"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Filter Kategori -->
        <div class="md:flex justify-between items-center mb-4">
            <div class="mb-4 md:mb-0">
                <div class="flex space-x-4">
                    <a href="{{ route('home') }}" class="text-black font-semibold hover:border-b-2 border-black">Semua Kategori</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('home', ['category' => $category->id]) }}" class="text-black font-semibold hover:border-b-2 border-black">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <!-- Form Pencarian -->
            <div>
                <form action="{{ route('home') }}" method="GET" class="flex items-center bg-gray-300 rounded-lg px-4 py-2 w-full max-w-md">
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari berita..." class="flex-grow bg-transparent outline-none text-black placeholder-gray-400">
                    <button type="submit" class="text-blue-600 hover:text-blue-800 font-semibold px-2">
                        Cari
                    </button>
                </form>
            </div>
        </div>

        <!-- Berita Terbaru -->
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Berita Terbaru</h1>

        @if ($articles->isEmpty())
            <p class="text-lg font-semibold text-black">Tidak Ditemukan</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <img src="{{ Storage::disk('cloudinary')->url($article->image) }}"
                             alt="Image for {{ $article->title }}"
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $article->title }}</h2>
                            <span class="text-sm text-white font-semibold bg-yellow-500 p-1 rounded-md">{{ $article->category->name }}</span>
                            <p class="text-xs text-gray-500 mt-2">{{ $article->created_at->diffForHumans() }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
