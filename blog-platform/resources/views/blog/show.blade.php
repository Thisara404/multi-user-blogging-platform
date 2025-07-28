````blade
````blade
````blade
````blade
````blade
````blade
````blade
````blade
````blade
````blade
````blade
````blade
````blade
````blade
````blade
````blade
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $post->title }}
            </h2>

            @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Post
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($post->featured_image)
                    <img src="{{ asset($post->featured_image) }}"
                         alt="{{ $post->title }}"
                         class="w-full h-64 object-cover">
                @endif

                <div class="p-8">
                    <!-- Post Meta -->
                    <div class="flex items-center text-sm text-gray-500 mb-6">
                        <span class="inline-block w-3 h-3 rounded-full mr-2"
                              style="background-color: {{ $post->category->color }}"></span>
                        <a href="{{ route('category.show', $post->category) }}"
                           class="hover:text-gray-700">{{ $post->category->name }}</a>
                        <span class="mx-2">•</span>
                        <span>{{ $post->published_at->format('F j, Y') }}</span>
                        <span class="mx-2">•</span>
                        <span>By {{ $post->author->name }}</span>
                    </div>

                    <!-- Post Content -->
                    <div class="prose max-w-none mb-8">
                        {!! $post->content !!}
                    </div>

                    <!-- Post Stats -->
                    <div class="flex items-center justify-between border-t border-gray-200 pt-6 mb-6">
                        <div class="flex items-center space-x-6 text-sm text-gray-500">
                            <span>👀 {{ $post->views_count }} views</span>
                            <span>❤️ {{ $post->likes_count }} likes</span>
                            <span>💬 {{ $post->comments_count }} comments</span>
                        </div>

                        @auth
                            <div class="flex items-center space-x-4">
                                <!-- Like Button -->
                                <button onclick="toggleLike({{ $post->id }})"
                                        class="flex items-center space-x-1 {{ $hasLiked ? 'text-red-600' : 'text-gray-500' }} hover:text-red-600">
                                    <svg class="w-5 h-5" fill="{{ $hasLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    <span id="like-text">{{ $hasLiked ? 'Unlike' : 'Like' }}</span>
                                </button>

                                <!-- Save Button -->
                                <button onclick="toggleSave({{ $post->id }})"
                                        class="flex items-center space-x-1 {{ $hasSaved ? 'text-blue-600' : 'text-gray-500' }} hover:text-blue-600">
                                    <svg class="w-5 h-5" fill="{{ $hasSaved ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                    </svg>
                                    <span id="save-text">{{ $hasSaved ? 'Unsave' : 'Save' }}</span>
                                </button>
                            </div>
                        @endauth
                    </div>

                    <!-- Tags -->
                    @if($post->tags->count() > 0)
                        <div class="flex flex-wrap gap-2 mb-8">
                            @foreach($post->tags as $tag)
                                <a href="{{ route('tag.show', $tag) }}"
                                   class="inline-block bg-gray-100 hover:bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <!-- Comments Section -->
                    @auth
                        @can('comment on posts')
                            <div class="border-t border-gray-200 pt-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Leave a Comment</h3>
                                <form action="{{ route('comments.store', $post) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <textarea name="content"
                                                  rows="4"
                                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                  placeholder="Write your comment here..."
                                                  required></textarea>
                                        @error('content')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Post Comment
                                    </button>
                                </form>
                            </div>
                        @endcan
                    @else
                        <div class="border-t border-gray-200 pt-8">
                            <p class="text-gray-600">
                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">Login</a>
                                to leave a comment.
                            </p>
                        </div>
                    @endauth

                    <!-- Display Comments -->
                    @if($post->approvedComments->count() > 0)
                        <div class="border-t border-gray-200 pt-8 mt-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">
                                Comments ({{ $post->approvedComments->count() }})
                            </h3>

                            @foreach($post->approvedComments->where('parent_id', null) as $comment)
                                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center mb-2">
                                        <strong class="text-gray-900">{{ $comment->user->name }}</strong>
                                        <span class="text-gray-500 text-sm ml-2">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700">{{ $comment->content }}</p>

                                    <!-- Replies -->
                                    @if($comment->replies->where('status', 'approved')->count() > 0)
                                        <div class="ml-6 border-l-2 border-gray-200 pl-4">
                                            @foreach($comment->replies->where('status', 'approved') as $reply)
                                                <div class="mb-4 p-3 bg-white rounded">
                                                    <div class="flex items-center mb-2">
                                                        @if($reply->user->avatar)
                                                            <img src="{{ $reply->user->avatar }}"
                                                                 alt="{{ $reply->user->name }}"
                                                                 class="w-6 h-6 rounded-full mr-2">
                                                        @endif
                                                        <strong class="text-gray-900 text-sm">{{ $reply->user->name }}</strong>
                                                        <span class="text-gray-500 text-xs ml-2">
                                                            {{ $reply->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    <p class="text-gray-700 text-sm">{{ $reply->content }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Reply Form -->
                                    @auth
                                        @can('comment on posts')
                                            <button onclick="toggleReplyForm({{ $comment->id }})"
                                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                Reply
                                            </button>
                                            <div id="reply-form-{{ $comment->id }}" class="hidden mt-3 ml-6">
                                                <form action="{{ route('comments.store', $post) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <div class="mb-3">
                                                        <textarea name="content"
                                                                  rows="3"
                                                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                                                  placeholder="Write your reply..."
                                                                  required></textarea>
                                                    </div>
                                                    <div class="flex gap-2">
                                                        <button type="submit"
                                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                            Reply
                                                        </button>
                                                        <button type="button"
                                                                onclick="toggleReplyForm({{ $comment->id }})"
                                                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-3 rounded text-sm">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endcan
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </article>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleLike(postId) {
            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.liked) {
                    document.getElementById('like-text').textContent = 'Unlike';
                } else {
                    document.getElementById('like-text').textContent = 'Like';
                }
            });
        }

        function toggleSave(postId) {
            fetch(`/posts/${postId}/save`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.saved) {
                    document.getElementById('save-text').textContent = 'Unsave';
                } else {
                    document.getElementById('save-text').textContent = 'Save';
                }
            });
        }

        function toggleReplyForm(commentId) {
            const form = document.getElementById(`reply-form-${commentId}`);
            form.classList.toggle('hidden');
        }
    </script>
    @endpush
</x-app-layout>
`````
