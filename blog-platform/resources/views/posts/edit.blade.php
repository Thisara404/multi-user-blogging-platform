<x-app-layout>
    {{-- @php
use Illuminate\Support\Facades\Storage;
@endphp --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data"
                        id="post-form">
                        @csrf
                        @method('PATCH')

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div class="mb-4">
                            <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt
                                (Optional)</label>
                            <textarea name="excerpt" id="excerpt" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt', $post->excerpt) }}</textarea>
                            @error('excerpt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" id="category_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                @foreach ($tags as $tag)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            {{ in_array($tag->id, old('tags', $selectedTags)) ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700">{{ $tag->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('tags')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Featured Image -->
                        <div class="mb-4">
                            <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured
                                Image</label>
                            <input type="file" name="featured_image" id="featured_image" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @if ($post->featured_image)
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600">Current Image:</p>
                                    <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}"
                                        class="w-full h-64 object-cover">
                                </div>
                            @endif
                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" id="content" rows="20"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div id="content-error" class="mt-1 text-sm text-red-600 hidden">Content is required.</div>
                        </div>

                        <!-- Status -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <div class="flex gap-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="draft"
                                        class="form-radio text-indigo-600"
                                        {{ old('status', $post->status) === 'draft' ? 'checked' : '' }}>
                                    <span class="ml-2">Save as Draft</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="published"
                                        class="form-radio text-indigo-600"
                                        {{ old('status', $post->status) === 'published' ? 'checked' : '' }}>
                                    <span class="ml-2">Publish Now</span>
                                </label>
                            </div>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('blog.show', $post) }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" id="submit-btn"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY', 'no-api-key') }}/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#content',
                height: 400,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic forecolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });

            // Custom form validation for TinyMCE
            document.getElementById('post-form').addEventListener('submit', function(e) {
                const content = tinymce.get('content').getContent();
                const contentError = document.getElementById('content-error');

                contentError.classList.add('hidden');

                if (!content.trim() || content.trim() === '<p></p>' || content.trim() === '<p><br></p>') {
                    e.preventDefault();
                    contentError.classList.remove('hidden');
                    tinymce.get('content').focus();
                    document.getElementById('content').scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    return false;
                }

                tinymce.get('content').save();
            });
        </script>
    @endpush
</x-app-layout>
