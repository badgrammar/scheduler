<div class="space-y-3 p-3">
    <div class="flex items-center justify-between border border-gray-200 p-3">
        <div class="font-semibold">Tasks list</div>
        <div>
            <label for="taskCreate"
                class="cursor-pointer rounded bg-gray-200 px-4 py-2 text-xs text-gray-800">+ Create</label>
            <input type="checkbox"
                id="taskCreate"
                class="modal-toggle" />
            <x-tasks-create />
        </div>
    </div>
    <table class="table-sm table-pin-rows table-pin-cols table rounded-none border border-gray-200">
        <tr class="font-semibold">
            <td>Prioritas</td>
            <td>Tujuan</td>
            <td>Pekerjaan</td>
            <td>Keterangan</td>
            <td>Tanggal dibuat</td>
            <td>Status</td>
            <td>Jadwal</td>
            <th></th>
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td>
                    @if ($task->prioritas === 'normal')
                        <span class="rounded-xl bg-gray-200 px-4 text-gray-800">{{ $task->prioritas }}</span>
                    @elseif($task->prioritas === 'high')
                        <span class="rounded-xl bg-red-200 px-4 text-red-800">{{ $task->prioritas }}</span>
                    @endif
                </td>
                <td>{{ $task->tujuan }}</td>
                <td>{{ $task->pekerjaan }}</td>
                <td>{{ $task->keterangan }}</td>
                <td>
                    <span style="font-size: 11px">@tanggal($task->created_at)</span>
                </td>
                <td style="font-size: 11px">
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
                </td>
                <td>
                    @if (is_null($task->tanggal))
                        <span style="font-size: 11px">-</span>
                    @else
                        <span style="font-size: 11px">@tanggal($task->tanggal) @jam($task->jam)</span>
                    @endif
                </td>
                <td class="flex w-fit items-center gap-1">
                    <div>
                        <label for="taskEdit_{{ $task->id }}"
                            class="cursor-pointer">
                            <span class="material-symbols-rounded text-slate-800"
                                style="font-size: 18px">edit_square</span>
                        </label>
                        <input type="checkbox"
                            id="taskEdit_{{ $task->id }}"
                            class="modal-toggle" />
                        <x-task-edit :task="$task" />
                    </div>
                    <div>
                        <label for="taskView_{{ $task->id }}"
                            class="cursor-pointer">
                            <span class="material-symbols-rounded text-blue-800"
                                style="font-size: 18px">find_in_page</span>
                        </label>
                        <input type="checkbox"
                            id="taskView_{{ $task->id }}"
                            class="modal-toggle" />
                        <x-task-details :task="$task" />
                    </div>
                    <a href="{{ route('tasks.delete', ['id' => $task->id]) }}">
                        <span class="material-symbols-rounded text-red-800">delete</span>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
