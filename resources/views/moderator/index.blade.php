<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Moderator') }}    
            </h2>
        </div>
    </x-slot>
    <div>
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">Select Status</h2>
        <form method="GET" action="{{ route('moderator.index') }}" class="mb-6 flex space-x-4">
            <select name="status" class="px-4 py-2 border rounded-md">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Reject</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Filter</button>
        </form>
    </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 p-4">
        
            @foreach($posts as $post)
                @if(Auth::user()->id == $post->creator->id || Auth::user()->role === 'admin')
                    <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-xl transition duration-300 ease-in-out">
                    <h3 class="text-2xl font-semibold mb-4 {{ $post->status === 'rejected' ? 'text-red-600' : ($post->status === 'pending' ? 'text-blue-600' : 'text-gray-800') }}">
                        {{ ucfirst($post->status) }}
                    </h3>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{$post->id}}. {{$post->title}}</h3>
                        <p class="text-lg text-gray-600 mb-4">{{$post->post_content}}</p>
                        <h3 class="text-1xl font-semibold text-blue-800 mb-4">Created By: {{ $post->creator ? $post->creator->name : 'Unknown' }}</h3>
                        <div class="mt-4">  
                            @foreach($post->tags as $tag)
                                <span class="text-blue-500">#{{ $tag->title }}</span>
                            @endforeach 
                        </div>
                        @if(Auth::user()->role === 'admin'&& $post->status === 'pending')
                            <div class="mt-4">
                            <a href="{{ route('moderator.show', ['post' => $post->id]) }}" class="text-blue-500 hover:text-blue-700 transition duration-300">Change Status</a>
                            </div>
                        @endif
                        @if(Auth::user()->role === 'user' && $post->status === 'rejected')
                            <div class="mt-4">
                            <a href="{{route('moderator.edit', ['post' => $post->id])}}" class="text-blue-500 hover:text-blue-700 transition duration-300">Change Post</a>
                            </div>
                        @endif
                        <label for="post" class="block text-red-700 text-lg font-semibold mb-2">{{$post->moderator_comments ? "Comments ".$post->moderator_comments : ""}}</label>
                        
                    </div>
                @endif
            @endforeach
            
        </div>
        <div class="flex justify-center mt-8">
        <div class="flex justify-center mt-8">
    {{ $posts->withQueryString()->links() }}
</div>
    </div>
    </div>
</x-app-layout>