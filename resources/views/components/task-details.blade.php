<div class="modal"
    role="dialog">
    <div class="modal-box max-h-3/4 p-0">
        <div class="sticky top-0 space-y-1 bg-white p-4">
            <div class="space-x-2 text-sm">
                <span>#{{ $task->id }}</span>
                <span>{{ $task->tujuan }}</span>
                @if ($task->prioritas === 'normal')
                    <span class="badge badge-sm badge-soft badge-neutral">{{ $task->prioritas }}</span>
                @elseif($task->prioritas === 'high')
                    <span class="badge badge-sm badge-soft badge-error">{{ $task->prioritas }}</span>
                @endif
            </div>
            <div>{{ $task->pekerjaan }}</div>
            <div class="flex space-x-2">
                @switch($task->status)
                    @case('pending')
                        <span class="badge badge-sm badge-soft badge-warning">{{ $task->status }}</span>
                    @break

                    @case('rescheduled')
                        <span class="badge badge-sm badge-soft badge-primary">{{ $task->status }}</span>
                    @break

                    @case('assigned')
                        <span class="badge badge-sm badge-soft badge-primary">{{ $task->status }}</span>
                    @break

                    @case('confirmed')
                        <span class="badge badge-sm badge-soft badge-success">{{ $task->status }}</span>
                    @break

                    @case('closed')
                        <span class="badge badge-sm badge-soft badge-secondary">{{ $task->status }}</span>
                    @break

                    @case('canceled')
                        <span class="badge badge-sm badge-soft badge-error">{{ $task->status }}</span>
                    @break
                @endswitch
                @if (!$task->tanggal)
                    <span>-</span>
                @elseif($task->tanggal)
                    <span>@tanggal($task->tanggal)</span>
                    <span>@jam($task->jam)</span>
                @endif
            </div>
            <div class="flex">
                <span class="w-24 font-semibold">Team</span>
                <div>
                    @foreach ($team->members as $member)
                        <span>{{ $member->panggilan }}{{ $loop->last ? '' : ',' }}</span>
                    @endforeach
                </div>
            </div>
            <div class="flex w-64">
                <span class="w-24 font-semibold">Keterangan</span>
                <span>{{ $task->keterangan }}</span>
            </div>
        </div>
        <div class="flex flex-col-reverse overflow-y-auto p-4">
            @foreach ($task->log as $items)
                <div class="flex flex-col space-y-2 border-b border-gray-200 py-2">
                    <div class="flex items-end justify-between">
                        <span>{{ $items->user->name }}</span>
                        <span class="text-[11px] text-gray-400">@tanggaljam($items->created_at)</span>
                    </div>
                    <span>{{ $items->comment }}</span>
                </div>
            @endforeach
        </div>
        <div class="sticky bottom-0 bg-white p-4">
            <form action="{{ route('logs.store') }}"
                method="POST"
                class="w-full space-y-2">
                @csrf
                <textarea name="comment"
                    placeholder="Comment"
                    class="w-full border border-gray-200 p-3"></textarea>
                <input type="hidden"
                    name="taskId"
                    value="{{ $task->id }}">
                <div class="flex justify-end space-x-4">
                    <button type="button"
                        class="cursor-pointer rounded bg-gray-200 px-4 py-2 text-xs text-gray-800"
                        onclick="closeTaskDetail({{ $task->id }})">Close</button>
                    <button type="submit"
                        class="cursor-pointer rounded bg-slate-800 px-4 py-2 text-xs text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function closeTaskDetail(id) {
        event.stopPropagation();
        document.getElementById('task_detail_' + id).checked = false;
        console.log('close');
    }
</script>
