<div class="flex flex-col gap-3">
    <div class="flex justify-between items-center">
        <div class="font-semibold">Tasks</div>
        <div>
            <label
                for="assign_task_{{$team->id}}"
                class="cursor-pointer px-3 py-1 bg-slate-800 text-white rounded"
            >
                Assign Task
            </label>
            <input
                type="checkbox"
                id="assign_task_{{$team->id}}"
                class="modal-toggle"
            />
            <x-task-assign :date="$date" :team="$team" />
        </div>
    </div>
    @if($tasks->isEmpty())
    <div class="overflow-x-auto rounded-box border border-gray-200">
        <table class="table table-sm">
            <tr class="bg-gray-200">
                <td>Prioritas</td>
                <td>Tujuan</td>
                <td>Pekerjaan</td>
                <td>Jam</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5" class="w-full text-center" colspan>
                    Tasks not found
                </td>
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
                <td class="w-48"></td>
            </tr>
            @foreach ($tasks as $task)
            <tr>
                <td>
                    @if($task->prioritas === 'normal')
                    <span
                        class="px-4 bg-gray-200 text-gray-800 rounded-xl"
                        >{{ $task->prioritas }}</span
                    >
                    @elseif($task->prioritas === 'high')
                    <span
                        class="px-4 bg-red-200 text-red-800 rounded-xl"
                        >{{ $task->prioritas }}</span
                    >
                    @endif
                </td>
                <td>{{ $task->tujuan }}</td>
                <td>{{ $task->pekerjaan }}</td>
                <td>
                    @if(!$task->jam)
                    <span>-</span>
                    @else
                    <span>@jam($task->jam)</span>
                    @endif
                </td>
                <td class="flex gap-3">
                    <label
                        for="taskView_{{$task->id}}"
                        class="cursor-pointer px-3 py-1 bg-gray-200 text-gray-800 rounded"
                    >
                        View
                    </label>
                    <input
                        type="checkbox"
                        id="taskView_{{$task->id}}"
                        class="modal-toggle"
                    />
                    <x-task-details :task="$task" />
                    <label
                        for="taskView_{{$task->id}}"
                        class="cursor-pointer px-3 py-1 bg-gray-200 text-gray-800 rounded"
                    >
                        Reschedule
                    </label>
                    <input
                        type="checkbox"
                        id="taskView_{{$task->id}}"
                        class="modal-toggle"
                    />
                    <x-task-details :task="$task" />
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif
</div>
