<x-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Konten Utama -->
            <div class="lg:col-span-2">
                <div>
                    <h1 class="text-5xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>
                    <div class="text-sm text-gray-600 mb-6">
                        Oleh <span class="text-blue-600 font-semibold">{{ $article->user->name }}</span>
                        <span class="mx-1">|</span>
                        {{ $article->created_at->diffForHumans() }}
                        <span class="mx-1">|</span>
                        <span class="text-gray-800 font-semibold">{{ $article->category->name }}</span>
                    </div>
                    <img src="{{ Storage::disk('cloudinary')->url($article->image) }}" alt="{{ $article->title }}" class="w-full h-auto object-cover rounded-lg shadow-md">
                    <div class="prose max-w-none text-gray-800 mb-6">
                        {!! $article->content !!}
                    </div>

                    <!-- Komentar -->
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Tinggalkan Komentar</h2>
                    @auth
                        <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
                            @csrf
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <textarea name="content" rows="4" required maxlength="500" class="w-full p-3 border border-gray-300 rounded-lg mb-2" placeholder="Tulis komentar..."></textarea>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Kirim Komentar</button>
                        </form>
                    @else
                        <p class="text-sm text-gray-500">
                            Silakan <a href="{{ route('login') }}" class="text-blue-600 font-semibold">login</a> untuk menambahkan komentar.
                        </p>
                    @endauth

                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Semua Komentar</h3>
                        @if($article->comments->whereNull('parent_id')->isEmpty())
                            <p class="text-gray-500">Belum ada komentar.</p>
                        @else
                            @foreach ($article->comments->whereNull('parent_id') as $comment)
                                <!-- Komentar Utama -->
                                <div class="border border-gray-300 rounded-lg p-4 mb-4 bg-gray-50">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $comment->user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                        @auth
                                            @if (auth()->id() !== $comment->user_id)
                                                <form action="{{ route('comments.report', $comment->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-red-500 text-sm">Laporkan</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="mt-3 text-gray-800">{{ $comment->content }}</p>
                                    @auth
                                        @if (auth()->id() !== $comment->user_id)
                                            <button type="button" class="text-blue-500 text-sm mt-3 toggle-reply"
                                                data-reply-id="{{ $comment->id }}"
                                                data-replied-name="{{ $comment->user->name }}">
                                                Balas
                                            </button>
                                        @endif
                                    @endauth

                                    <!-- Form Balasan -->
                                    <form id="reply-form-{{ $comment->id }}" action="{{ route('comments.reply') }}" method="POST" class="mt-3 hidden reply-form">
                                        @csrf
                                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <textarea name="content" rows="2" required maxlength="500" class="w-full p-3 border border-gray-300 rounded-lg mb-2" placeholder="Balas komentar..."></textarea>
                                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md">Kirim Balasan</button>
                                    </form>

                                    <!-- Balasan -->
                                    @if ($comment->replies->isNotEmpty())
                                        <button type="button" class="text-blue-500 text-sm mt-2 toggle-replies" data-reply-id="{{ $comment->id }}">
                                            Lihat Balasan ({{ $comment->replies->count() }})
                                        </button>
                                        <div id="replies-{{ $comment->id }}" class="ml-6 mt-3 hidden">
                                            @foreach ($comment->replies as $reply)
                                                <div class="border border-gray-300 rounded-lg p-3 mb-3 bg-gray-100">
                                                    <div class="flex justify-between items-center">
                                                        <div>
                                                            <p class="font-semibold text-gray-800">{{ $reply->user->name }}</p>
                                                            <p class="text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                                        </div>
                                                        @auth
                                                            @if (auth()->id() !== $reply->user_id)
                                                                <form action="{{ route('comments.report', $reply->id) }}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="text-red-500 text-sm">Laporkan</button>
                                                                </form>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                    <p class="mt-2 text-gray-800">{{ $reply->content }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Berita Terkait -->
            <div class="lg:col-span-1">
                <div class="p-6 bg-gray-50 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Berita Terkait</h2>
                    <div class="space-y-6">
                        @foreach ($relatedArticles as $relatedArticle)
                            <a href="{{ route('articles.show', $relatedArticle->slug) }}" class="block">
                                <img src="{{ $relatedArticle->image ? asset('storage/' . $relatedArticle->image) : asset('images/default-image.jpg') }}"
                                    alt="{{ $relatedArticle->title }}" class="w-full h-48 object-cover rounded-lg mb-3">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $relatedArticle->title }}</h3>
                                <p class="text-sm text-gray-500">
                                    {{ $relatedArticle->created_at->format('d M Y') }} |
                                    <span class="font-semibold">{{ $relatedArticle->category->name }}</span>
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle reply form
            const toggleReplyButtons = document.querySelectorAll('.toggle-reply');
            toggleReplyButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const replyId = this.dataset.replyId;
                    const replyForm = document.getElementById(`reply-form-${replyId}`);
                    if (replyForm) {
                        replyForm.classList.toggle('hidden');
                    }
                });
            });

            // Toggle replies
            const toggleRepliesButtons = document.querySelectorAll('.toggle-replies');
            toggleRepliesButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const replyId = this.dataset.replyId;
                    const repliesContainer = document.getElementById(`replies-${replyId}`);
                    if (repliesContainer) {
                        repliesContainer.classList.toggle('hidden');
                    }
                });
            });
        });
    </script>
</x-layout>
