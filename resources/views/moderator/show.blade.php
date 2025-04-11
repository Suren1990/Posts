<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-start min-h-screen py-10 px-4 bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-4xl bg-white dark:bg-gray-800 shadow-md rounded-xl p-8 transition hover:shadow-xl">
            <h3 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white mb-4">
                #{{ $post->id }} — {{ $post->title }}
            </h3>
            <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed mb-4">
                {{ $post->post_content }}
            </p>
            <div class="text-sm text-gray-600 dark:text-gray-400 font-medium mb-4">
                Create by: {{ $post->creator ? $post->creator->name : 'Unknown' }}
            </div>
            <div class="mb-6">
                @foreach($post->tags as $tag)
                    <span class="inline-block bg-blue-100 text-blue-600 dark:bg-blue-800 dark:text-blue-200 text-sm font-medium mr-2 px-3 py-1 rounded-full">
                        #{{ $tag->title }}
                    </span>
                @endforeach
            </div>
            <div class="mt-8">
                <div class="mb-4">
                    <a href="{{ route('moderator.index') }}"
                       class="inline-flex items-center text-sm gap-2 bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                        Back
                    </a>
                </div>
                <form method="POST" action="{{ route('moderator.reject', $post->id) }}" class="mb-6">
                    @csrf
                    <label for="moderator_comments" class="block text-gray-800 dark:text-gray-200 text-lg font-semibold mb-2">
                        Moderator comment
                    </label>
                    <textarea id="moderator_comments" name="moderator_comments"
                              class="w-full p-4 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 resize-none"
                              rows="4" placeholder="Comments..."></textarea>

                    <div class="flex justify-center gap-6 mt-6">
                        <button type="submit"
                                class="bg-red-500 text-white font-semibold py-2 px-6 rounded-lg hover:bg-red-600 transition duration-300 shadow">
                            Reject
                        </button>
                </form>
                <form method="POST" action="{{ route('moderator.accept', $post->id) }}">
                    @csrf
                    <button type="submit"
                            class="bg-green-500 text-white font-semibold py-2 px-6 rounded-lg hover:bg-green-600 transition duration-300 shadow">
                        Accept
                    </button>
                </form>
            </div>
            
        </div>
    </div>
    
</x-app-layout>
