<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-8 mt-0" style="margin-top: 4px;">
    <h2 class="text-3xl font-semibold text-gray-900 mb-6">Select Post</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-xl transition duration-300 ease-in-out">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-semibold text-gray-800">{{$post->id}}. {{$post->title}}</h3>
                <div class="flex space-x-2">
                    <!-- Edit Button -->
                    <a href="{{ route('post.store', $post->id)}}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                        Back
                    </a>
                    <a href="{{ route('post.edit', $post->id)}}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                        Edit
                    </a>
                    <!-- Delete Button -->
                    <form method="POST" action="{{ route('post.delete', $post->id)}}" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
        
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <p class="text-lg text-gray-600 mb-4">{{$post->post_content}}</p>
            @foreach($post->tags as $tag)
                <span class="text-blue-500">#{{ $tag->title }}</span>
            @endforeach 
        </div>
    </div>
</div>
</x-app-layout>