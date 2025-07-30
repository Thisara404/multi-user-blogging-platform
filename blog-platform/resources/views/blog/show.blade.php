<x-app-layout>
{{-- @php
use Illuminate\Support\Facades\Storage;
@endphp --}}

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
                    <img src="https://thisaradasun.s3.eu-north-1.amazonaws.com/{{ $post->featured_image }}"
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
                            <span>💬 {{ $post->approvedComments->count() }} comments</span>
                            <span>❤️ <span id="likes-count">{{ $post->likes_count }}</span> likes</span>
                        </div>

                        @auth
                            <div class="flex space-x-3">
                                <button onclick="toggleLike({{ $post->id }})"
                                        class="flex items-center space-x-2 px-4 py-2 rounded-lg {{ $hasLiked ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600' }} hover:bg-opacity-80 transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span id="like-text">{{ $hasLiked ? 'Unlike' : 'Like' }}</span>
                                </button>

                                <button onclick="toggleSave({{ $post->id }})"
                                        class="flex items-center space-x-2 px-4 py-2 rounded-lg {{ $hasSaved ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-600' }} hover:bg-opacity-80 transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path>
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
                                   class="inline-block bg-gray-100 hover:bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 transition-colors">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <!-- Comments Section -->
                    @auth
                        @can('comment on posts')
                            <div class="border-t border-gray-200 pt-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Add Comment</h3>
                                <form method="POST" action="{{ route('comments.store', $post) }}">
                                    @csrf
                                    <div class="mb-4">
                                        <textarea name="content"
                                                  rows="4"
                                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                  placeholder="Write your comment here..."
                                                  required></textarea>
                                    </div>
                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Post Comment
                                    </button>
                                </form>
                            </div>
                        @endcan
                    @else
                        <div class="border-t border-gray-200 pt-8 text-center">
                            <p class="text-gray-600 mb-4">Please log in to leave a comment</p>
                            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Log In
                            </a>
                        </div>
                    @endauth

                    <!-- Display Comments -->
                    @if($post->approvedComments->count() > 0)
                        <div class="border-t border-gray-200 pt-8 mt-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Comments ({{ $post->approvedComments->count() }})</h3>
                            @foreach($post->approvedComments->where('parent_id', null) as $comment)
                                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-start space-x-4">
                                        @if($comment->user->avatar)
                                            <img src="{{ $comment->user->avatar }}"
                                                 alt="{{ $comment->user->name }}"
                                                 class="w-10 h-10 rounded-full">
                                        @else
                                            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                                <span class="text-gray-600 font-semibold">{{ substr($comment->user->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-2">
                                                <h4 class="font-semibold text-gray-900">{{ $comment->user->name }}</h4>
                                                <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-gray-700">{{ $comment->content }}</p>

                                            @auth
                                                @can('comment on posts')
                                                    <button onclick="toggleReplyForm({{ $comment->id }})"
                                                            class="mt-3 text-sm text-blue-600 hover:text-blue-800">
                                                        Reply
                                                    </button>
                                                @endcan
                                            @endauth

                                            <!-- Replies -->
                                            @if($comment->replies->where('status', 'approved')->count() > 0)
                                                <div class="mt-4 ml-6 space-y-4">
                                                    @foreach($comment->replies->where('status', 'approved') as $reply)
                                                        <div class="p-3 bg-white rounded border">
                                                            <div class="flex items-center space-x-2 mb-2">
                                                                <h5 class="font-medium text-gray-900">{{ $reply->user->name }}</h5>
                                                                <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            <p class="text-gray-700 text-sm">{{ $reply->content }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    @auth
                                        @can('comment on posts')
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
                const likeButton = document.querySelector('button[onclick="toggleLike(' + postId + ')"]');
                const likeText = document.getElementById('like-text');
                const likesCount = document.getElementById('likes-count');

                if (data.liked) {
                    likeText.textContent = 'Unlike';
                    likeButton.className = 'flex items-center space-x-2 px-4 py-2 rounded-lg bg-red-100 text-red-600 hover:bg-opacity-80 transition-colors';
                } else {
                    likeText.textContent = 'Like';
                    likeButton.className = 'flex items-center space-x-2 px-4 py-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-opacity-80 transition-colors';
                }

                likesCount.textContent = data.likes_count;
            })
            .catch(error => {
                console.error('Error:', error);
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
                const saveButton = document.querySelector('button[onclick="toggleSave(' + postId + ')"]');
                const saveText = document.getElementById('save-text');

                if (data.saved) {
                    saveText.textContent = 'Unsave';
                    saveButton.className = 'flex items-center space-x-2 px-4 py-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-opacity-80 transition-colors';
                } else {
                    saveText.textContent = 'Save';
                    saveButton.className = 'flex items-center space-x-2 px-4 py-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-opacity-80 transition-colors';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function toggleReplyForm(commentId) {
            const form = document.getElementById(`reply-form-${commentId}`);
            form.classList.toggle('hidden');
        }
    </script>
    @endpush
</x-app-layout>
