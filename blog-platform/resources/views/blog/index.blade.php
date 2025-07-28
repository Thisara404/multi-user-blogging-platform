<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blog Posts') }}
            </h2>
            @can('create', App\Models\Post::class)
                <a href="{{ route('posts.create') }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Post
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($posts as $post)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        @if($post->featured_image)
                            <img src="{{ asset($post->featured_image) }}"
                                 alt="{{ $post->title }}"
                                 class="w-full h-48 object-cover">
                        @endif

                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <span class="inline-block w-3 h-3 rounded-full mr-2"
                                      style="background-color: {{ $post->category->color }}"></span>
                                {{ $post->category->name }}
                                <span class="mx-2">•</span>
                                {{ $post->published_at->format('M d, Y') }}
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                <a href="{{ route('blog.show', $post) }}"
                                   class="hover:text-blue-600">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            @if($post->excerpt)
                                <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 100) }}</p>
                            @endif

                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <span class="mr-4">👀 {{ $post->views_count }}</span>
                                    <span class="mr-4">❤️ {{ $post->likes_count }}</span>
                                    <span>💬 {{ $post->comments_count }}</span>
                                </div>

                                <a href="{{ route('blog.show', $post) }}"
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                    Read More
                                </a>
                            </div>

                            @if($post->tags->count() > 0)
                                <div class="mt-4 flex flex-wrap gap-1">
                                    @foreach($post->tags->take(3) as $tag)
                                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No posts yet</h3>
                        <p class="text-gray-600">Be the first to create a blog post!</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
