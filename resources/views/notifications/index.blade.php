@extends('layouts.app')

@section('content')
    <h1 class="mb-8">
        @lang('words.notifications')
        <span class="text-gray-800 text-xl font-normal">
            ({{ trans('words.total', ['total' => $notifications->total()]) }})
        </span>
    </h1>

    <table class="w-full mb-8">
        @forelse($notifications as $notification)
            <tr class="border-b {{ $notification->read_at ? 'opacity-50' : '' }}">
                <td class="py-2 px-3">
                    @if($notification->read_at)
                        <div title="Read notification" class="w-3 h-3 border-2 border-blue-500 rounded-full"></div>
                    @else
                        <div title="Unread notification" class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    @endif
                </td>
                <td class="py-2 px-3" title="{{ $notification->created_at }}">
                    <span class="block text-xl text-center font-semibold">
                        {{ $notification->created_at->day }}
                    </span>
                    <span class="block text-center">
                        {{ $notification->created_at->shortMonthName }}
                    </span>
                </td>
                <td class="py-2 px-3">
                    <h3 class="font-semibold">{{ $notification->data['title'] ?? 'Notification without title' }}</h3>
                    <div class="text-sm">
                        @include(config("notifications.{$notification->type}.view"), compact('notification'))
                    </div>
                </td>
                @if($link = $notification->data['link'] ?? null)
                    <div>
                        <a class="btn btn-primary" href="{{ $link }}">
                            @lang('words.link')
                        </a>
                    </div>
                @endif
            </tr>
        @empty
            <h2>
                @lang('words.no_notifications')
            </h2>
        @endforelse
    </table>

    <div class="flex justify-center">
        {{ $notifications->links() }}
    </div>
@endsection
