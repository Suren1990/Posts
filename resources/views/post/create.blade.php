<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <form method="POST" action="{{ route('post.store') }}" class="max-w-md mx-auto p-6 bg-gray-100 shadow-lg rounded-lg">
    @csrf

    <!-- Title Field -->
    <div class="mb-4">
        <label for="title" class="block text-gray-700 text-lg font-semibold mb-2">Title</label>
        <input type="text" id="title" name="title" class="w-full p-3 border border-gray-300 rounded-lg" required>
        @error('title')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Post Content Field -->
    <div class="mb-4">
        <label for="post" class="block text-gray-700 text-lg font-semibold mb-2">Post Content</label>
        <textarea id="post" name="post_content" class="w-full p-3 border border-gray-300 rounded-lg" rows="5" required></textarea>
        @error('post_content')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-lg font-medium text-gray-700">Select Tags</label>
        <select id="tags_id" name="tags[]" multiple class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->title }}</option>
        @endforeach
        </select>
        <p class="text-sm text-gray-500 mt-1">Hold Ctrl (or Cmd) to select multiple tags.</p>
    </div>

    <!-- Submit Button -->
    <a href="{{ route('post.index')}}" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 inline-flex items-center justify-center">
        Back
    </a>
    <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300 inline-flex items-center justify-center">
        Create
    </button>
</form>
</x-app-layout>