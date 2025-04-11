<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-8">
    <div class="flex justify-end mb-6 space-x-4">
        <a href="{{ route('post.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">
        Create New Post
        </a>
        <a href="{{ route('post.create') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300">
        Create New Tags
        </a>
    </div>
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">Select Author</h2>
        <form method="GET" action="{{ route('post.index') }}" class="mb-6 flex space-x-4">
        <select name="author" class="px-4 py-2 border rounded-md">
            <option value="">All Author</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}" 
            {{ (old('author') == $user->id || request()->input('author') == $user->id) ? 'selected' : '' }}>
            {{ $user->name }}
        </option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Filter</button>
        <div class="ml-auto flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title and post" class="px-2 py-2 border rounded-md w-48">
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition duration-300">Search</button>
            </div>
            <button type="reset" onclick="window.location='{{ route('post.index') }}'" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition duration-300">Reset</button>    
    </form>
    <div class="fixed right-10 top-45">
    </div>
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">Latest Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
            @foreach($posts as $post)
            @if($post->status == 'accepted')
            <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-xl transition duration-300 ease-in-out">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{$post->id}}. {{$post->title}}</h3>
                <p class="text-lg text-gray-600 mb-4">{{$post->post_content}}</p>
                <h3 class="text-1xl font-semibold text-red-800 mb-4">Created By: {{ $post->creator ? $post->creator->name : 'Unknown' }}</h3>
                @if(auth()->user()->id == $post->creator->id)
                    <a href="{{ route('post.show', $post->id) }}" class="text-blue-500 hover:text-blue-700 transition duration-300">Change Post</a>
                @endif
                <div class="mt-4">  
                    @foreach($post->tags as $tag)
                        <span class="text-blue-500">#{{ $tag->title }}</span>
                    @endforeach 
                </div>
            </div>
    @endif
            @endforeach
            
        </div>
        <div class="flex justify-center mt-8">
    <div class="flex justify-center mt-8>"
        {{$posts->withQueryString()->links()}}
    </div>
    </div>
    </div>
</x-app-layout>