<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- User Stats -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Stats</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Posts Written:</span>
                            <span class="font-semibold">{{ Auth::user()->posts()->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Comments Made:</span>
                            <span class="font-semibold">{{ Auth::user()->comments()->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Posts Liked:</span>
                            <span class="font-semibold">{{ Auth::user()->likes()->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Posts Saved:</span>
                            <span class="font-semibold">{{ Auth::user()->savedPosts()->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        @can('create posts')
                            <a href="{{ route('posts.create') }}"
                               class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                                Create New Post
                            </a>
                        @endcan

                        <a href="{{ route('blog.index') }}"
                           class="block w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center">
                            View All Posts
                        </a>

                        @hasrole('admin')
                            <a href="{{ route('admin.dashboard') }}"
                               class="block w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-center">
                                Admin Dashboard
                            </a>
                        @endhasrole
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                    <div class="space-y-3 text-sm">
                        @foreach(Auth::user()->posts()->latest()->take(3)->get() as $post)
                            <div class="border-b border-gray-200 pb-2">
                                <a href="{{ route('blog.show', $post) }}" class="text-blue-600 hover:text-blue-800">
                                    {{ Str::limit($post->title, 30) }}
                                </a>
                                <p class="text-gray-500 text-xs">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Saved Posts -->
            @if(Auth::user()->savedPosts()->count() > 0)
                <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Saved Posts</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach(Auth::user()->savedPosts()->latest('saved_posts.created_at')->take(6)->get() as $post)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-900 mb-2">
                                        <a href="{{ route('blog.show', $post) }}" class="hover:text-blue-600">
                                            {{ Str::limit($post->title, 50) }}
                                        </a>
                                    </h4>
                                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($post->excerpt, 80) }}</p>
                                    <p class="text-gray-500 text-xs">By {{ $post->author->name }}</p>
                                </div>
                            @endforeach
                        </div>

                        @if(Auth::user()->savedPosts()->count() > 6)
                            <div class="mt-4 text-center">
                                <a href="{{ route('user.saved-posts') }}" class="text-blue-600 hover:text-blue-800">
                                    View All Saved Posts ({{ Auth::user()->savedPosts()->count() }})
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
