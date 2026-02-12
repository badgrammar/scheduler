<div class="flex w-full flex-col gap-3 rounded bg-white p-3"
    {{ $attributes }}>
    <div>
        <div>
            {{ $task->tujuan }}
        </div>
        <div>
            <span class="text-xs">{{ $task->pekerjaan }}</span>
        </div>
    </div>
    <div class="flex gap-3 text-xs">
        @if ($task->prioritas === 'normal')
            <span class="w-fit rounded-xl bg-gray-200 px-4 text-gray-800">{{ $task->prioritas }}</span>
        @elseif($task->prioritas === 'high')
            <span class="w-fit rounded-xl bg-red-200 px-4 text-red-800">{{ $task->prioritas }}</span>
        @endif
        @switch($task->status)
            @case('pending')
                <span class="rounded-xl bg-yellow-200 px-4 text-yellow-800">{{ $task->status }}</span>
            @break

            @case('rescheduled')
                <span class="rounded-xl bg-gray-200 px-4 text-gray-800">{{ $task->status }}</span>
            @break

            @case('assigned')
                <span class="rounded-xl bg-blue-200 px-4 text-blue-800">{{ $task->status }}</span>
            @break

            @case('confirmed')
                <span class="rounded-xl bg-green-200 px-4 text-green-800">{{ $task->status }}</span>
            @break

            @case('closed')
                <span class="rounded-xl bg-gray-200 px-4 text-gray-800">{{ $task->status }}</span>
            @break

            @case('canceled')
                <span class="rounded-xl bg-red-200 px-4 text-red-800">{{ $task->status }}</span>
            @break
        @endswitch
    </div>
</div>
