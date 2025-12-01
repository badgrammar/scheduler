<div class="space-y-3">
    <div class="border border-gray-200 p-3 flex justify-between items-center">
        <div class="font-semibold">Tasks list</div>
        <div>
            <label for="taskCreate" class="rounded cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 text-xs">+ Create</label>
            <input type="checkbox" id="taskCreate" class="modal-toggle"/>
            <x-tasks-create/>
        </div>
    </div>
    <table class="table table-sm table-pin-rows table-pin-cols border border-gray-200 rounded-none">
        <tr class="font-semibold">
            <td>Prioritas</td>
            <td>Tujuan</td>
            <td>Pekerjaan</td>
            <td>Keterangan</td>
            <td>Tanggal dibuat</td>
            <td>Status</td>
            <th></th>
        </tr>
        @foreach($tasks as $task)
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
                <td>{{ $task->keterangan }}</td>
                <td>@tanggal($task->created_at)</td>
                <td>
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
                </td>
                <td class="flex gap-1 items-center w-fit">
                    <div>
                        <label for="taskEdit_{{$task->id}}" class="cursor-pointer">
                            <span class="material-symbols-rounded text-slate-800" style="font-size: 18px;">edit_square</span>
                        </label>
                        <input type="checkbox" id="taskEdit_{{$task->id}}" class="modal-toggle"/>
                        <x-task-edit :task="$task" />
                    </div>
                    <div>
                        <label for="taskView_{{$task->id}}" class="cursor-pointer">
                            <span class="material-symbols-rounded text-blue-800" style="font-size: 18px;">find_in_page</span>
                        </label>
                        <input type="checkbox" id="taskView_{{$task->id}}" class="modal-toggle"/>
                        <x-task-details :task="$task" />
                    </div>
                    <a href="{{route('tasks.delete', ['id' => $task->id])}}">
                        <span class="material-symbols-rounded text-red-800">delete</span>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
</div>