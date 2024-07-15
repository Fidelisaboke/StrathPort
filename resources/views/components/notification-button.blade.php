<div x-data="{ notificationOpen: false }" class="relative text-gray-600 focus:outline-none">
    <button @click="notificationOpen = !notificationOpen">
        <i class="text-2xl fas fa-bell"></i>
        @if ($unreadNotifications->count() > 0)
            <span class="absolute top-0 right-0 w-2 h-2 mt-1 mr-2 bg-red-600 rounded-full"></span>
        @endif
    </button>

    <div x-show="notificationOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="absolute right-0 z-10 mt-2 overflow-hidden bg-white rounded-lg shadow-xl w-80">
        <div class="divide-y divide-gray-200">
            @foreach ($unreadNotifications as $notification)
                @php
                    // Calculate the time difference to show in the notification
                    $time = \Carbon\Carbon::parse($notification->created_at);
                    $timeDifference = $time->diffForHumans();
                @endphp

                @empty($notification->data['action'])
                    <a class="flex flex-col items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-fuchsia-600"
                        href="{{ url('dashboard') }}" @click.prevent="markNotificationAsRead('{{ $notification->id }}')">
                        <h1 class="font-semibold">{{ $notification->data['subject'] }}</h1>
                        <p class="mx-2">
                            <span class="text-sm text-wrap">{{ $notification->data['message'] }}</span>
                        </p>
                        <span class="text-xs text-gray-400">{{ $timeDifference }}</span>
                    </a>
                @else
                    <a class="flex flex-col px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-fuchsia-600"
                        href="{{ $notification->data['action'] }}"
                        @click.prevent="markNotificationAsRead('{{ $notification->id }}', '{{ $notification->data['action']}}')">
                        <h1 class="font-semibold">{{ $notification->data['subject'] }}</h1>
                        <p class="mx-2 ">
                            <span class="text-sm text-wrap">{{ $notification->data['message'] }}</span>
                        </p>
                        <span class="mx-2 text-xs">{{ $timeDifference }}</span>
                    </a>
                @endempty
            @endforeach
        </div>
    </div>
</div>

<script>
    function markNotificationAsRead(id, action = null) {
        fetch(`/notifications/mark-as-read/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        }).then(response => response.json()).then(data => {
            if (data.success) {
                if (action) {
                    window.location.href = action;
                } else {
                    window.location.reload();
                }
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    }
</script>
