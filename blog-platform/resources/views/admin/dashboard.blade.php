<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Total Users</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ \App\Models\User::count() }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Total Posts</h3>
                    <p class="text-3xl font-bold text-green-600">{{ \App\Models\Post::count() }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Pending Comments</h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\Comment::where('status', 'pending')->count() }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Published Posts</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Post::where('status', 'published')->count() }}</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                    <div class="space-y-2">
                        <a href="{{ route('admin.users') }}" class="block bg-blue-500 text-white text-center py-2 rounded">Manage Users</a>
                        <a href="{{ route('admin.comments') }}" class="block bg-yellow-500 text-white text-center py-2 rounded">Moderate Comments</a>
                        <a href="{{ route('categories.index') }}" class="block bg-green-500 text-white text-center py-2 rounded">Manage Categories</a>
                        <a href="{{ route('tags.index') }}" class="block bg-purple-500 text-white text-center py-2 rounded">Manage Tags</a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Recent Posts</h3>
                    <div class="space-y-2">
                        @foreach(\App\Models\Post::latest()->take(5)->get() as $post)
                            <div class="border-b pb-2">
                                <a href="{{ route('blog.show', $post) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                    {{ Str::limit($post->title, 40) }}
                                </a>
                                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Recent Users</h3>
                    <div class="space-y-2">
                        @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                            <div class="border-b pb-2">
                                <p class="text-sm font-medium">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
