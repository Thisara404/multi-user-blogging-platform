<x-app-layout>
    {{-- @php
use Illuminate\Support\Facades\Storage;
@endphp --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        User</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Posts</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Joined</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if ($user->avatar)
                                                    <img class="h-10 w-10 rounded-full" src="{{ $user->avatar }}"
                                                        alt="{{ $user->name }}">
                                                @else
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <span
                                                            class="text-sm font-medium text-gray-700">{{ substr($user->name, 0, 2) }}</span>
                                                    </div>
                                                @endif
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if ($user->hasRole('admin')) bg-red-100 text-red-800
                                            @elseif($user->hasRole('editor')) bg-blue-100 text-blue-800
                                            @else bg-green-100 text-green-800 @endif">
                                                {{ $user->roles->first()->name ?? 'No Role' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->posts()->count() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->created_at->format('M j, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if ($user->id !== auth()->id())
                                                <form method="POST"
                                                    action="{{ route('admin.users.update-role', $user) }}"
                                                    class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="role" onchange="this.form.submit()"
                                                        class="text-sm border-gray-300 rounded">
                                                        <option value="reader"
                                                            {{ $user->hasRole('reader') ? 'selected' : '' }}>Reader
                                                        </option>
                                                        <option value="editor"
                                                            {{ $user->hasRole('editor') ? 'selected' : '' }}>Editor
                                                        </option>
                                                        <option value="admin"
                                                            {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin
                                                        </option>
                                                    </select>
                                                </form>
                                            @else
                                                <span class="text-gray-500">Current User</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($post->featured_image)
        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
    @endif
</x-app-layout>
