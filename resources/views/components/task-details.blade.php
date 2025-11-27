<div class="modal" role="dialog">
    <div class="modal-box max-w-[800px] min-w-lg space-y-8">
        <div class="space-y-1">
            <div class="font-semibold space-x-2 text-sm">
                <span>#{{$task->id}}</span>
                <span>{{$task->tujuan}}</span>
                @if($task->prioritas === 'normal')
                    <span class="px-4 bg-gray-200 text-gray-800 rounded-xl font-normal text-xs">{{ $task->prioritas }}</span>
                @elseif($task->prioritas === 'high')
                    <span class="px-4 bg-red-200 text-red-800 rounded-xl font-normal text-xs">{{ $task->prioritas }}</span>
                @endif
            </div>
            <div>{{$task->pekerjaan}}</div>
            <div class="flex space-x-2">
                @switch($task->status)
                    @case('pending')
                        <span class="px-4 bg-yellow-200 text-yellow-800 rounded-xl">{{ $task->status }}</span>
                        @break
                    @case('planned')
                        <span class="px-4 bg-lime-200 text-lime-800 rounded-xl">{{ $task->status }}</span>
                        @break
                    @case('assigned')
                        <span class="px-4 bg-teal-200 text-teal-800 rounded-xl">{{ $task->status }}</span>
                        @break
                    @case('confirmed')
                        <span class="px-4 bg-blue-200 text-blue-800 rounded-xl">{{ $task->status }}</span>
                        @break
                    @case('closed')
                        <span class="px-4 bg-gray-200 text-gray-800 rounded-xl">{{ $task->status }}</span>
                        @break
                    @case('canceled')
                        <span class="px-4 bg-red-200 text-red-800 rounded-xl">{{ $task->status }}</span>
                        @break
                @endswitch
                @if(!$task->tanggal)
                    <span class="px-4 bg-gray-200 text-gray-800 rounded-xl text-xs">not planned</span>
                @elseif($task->tanggal)
                    <span>{{$task->tanggal}}</span>
                @endif
                <span>{{$task->tanggal}}</span>
                <span>{{$task->jam}}</span>
            </div>
            <div class="flex">
                <span class="font-semibold w-24">Team</span>
                <span>-</span>
            </div>
            <div class="flex w-64">
                <span class="font-semibold w-24">Keterangan</span>
                <span>{{$task->keterangan}}</span>
            </div>
        </div>
        <div>
            @foreach($task->log as $items)
                <div class="flex flex-col space-y-2">
                    <div class="flex flex-col">
                        <span>{{$items->user->name}}</span>
                        <span class="text-[11px] text-gray-400">@tanggal($items->created_at)</span>
                    </div>
                    <span>{{$items->comment}}</span>
                </div>
            @endforeach
        </div>
        <div class="flex justify-end">
            <label for="taskView" class="rounded cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 text-xs">Close</label>
        </div>
    </div>
</div>