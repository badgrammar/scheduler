<div class="flex flex-col gap-3">
    <div class="font-semibold">Unassigned Tasks</div>
    @if($tasks->isEmpty())
    <div class="overflow-x-auto rounded-box border border-gray-200">
        <table class="table table-sm">
            <tr>
                <td class="w-full text-center">Tasks not found</td>
            </tr>
        </table>
    </div>
    @else
    <div class="overflow-x-auto rounded-box border border-gray-200">
        <table class="table table-sm">
            <tr class="bg-gray-200">
                <td>Prioritas</td>
                <td>Tujuan</td>
                <td>Pekerjaan</td>
                <td>Jam</td>
                <td class="w-36 "></td>
            </tr>
            @foreach ($tasks as $task)
            <tr>
                <td>
                    @if($task->prioritas === 'normal')
                    <span class="px-4 bg-gray-200 text-gray-800 rounded-xl">{{ $task->prioritas }}</span>
                    @elseif($task->prioritas === 'high')
                    <span class="px-4 bg-red-200 text-red-800 rounded-xl">{{ $task->prioritas }}</span>
                    @endif
                </td>    
                <td>{{ $task->tujuan }}</td>
                <td>{{ $task->pekerjaan }}</td>
                <td>
                    @if(!$task->jam)
                    <span class="px-4 bg-gray-200 text-gray-800 rounded-xl">{{ $task->status }}</span>
                    @else
                    <span>@jam($task->jam)</span>
                    @endif
                </td>
                <td class="flex gap-3">
                    <button class="cursor-pointer bg-gray-200 text-gray-800 rounded px-3 py-1">View</button>
                    <button class="cursor-pointer bg-slate-800 text-white rounded px-3 py-1">Assign</button>
                </td>
            </tr>            
            @endforeach
        </table>
    </div>
    @endif
</div>