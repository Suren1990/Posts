<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold">Your Notifications</h3>
                    <hr class="my-4 border-t border-gray-300 dark:border-gray-600">
                    <ul>
                        @foreach ($notifications as $notification)
                            <li class="py-2">
                                {{$loop->iteration.'.'}}
                                <div class="{{ $notification->is_read ? 'text-gray-500' : 'font-bold' }}">
                                    {{ $notification->message }}
                                </div>
                                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="inline">
                                    @csrf
                                    @if(!$notification->is_read)
                                        <button type="submit" class="text-blue-500 mr-2">Mark as read</button>
                                    @else
                                        <button type="submit" class="text-gray-400 mr-2 hover:text-blue-400">Mark again</button>
                                    @endif
                                </form>
                                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                                <hr class="my-4 border-t border-gray-300 dark:border-gray-600">
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-6">
    {{ $notifications->links() }}
</div>
            </div>
        </div>
    </div>
</x-app-layout>

