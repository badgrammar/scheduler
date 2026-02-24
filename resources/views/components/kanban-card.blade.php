<div class="flex w-full cursor-pointer flex-col gap-3 rounded bg-white p-3"
    wire:key="{{ $task->id }}"
    data-task-id="{{ $task->id }}"
    onclick="openTaskDetail({{ $task->id }})">
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
            <span class="badge badge-sm badge-soft badge-neutral">{{ $task->prioritas }}</span>
        @elseif($task->prioritas === 'high')
            <span class="badge badge-sm badge-soft badge-error">{{ $task->prioritas }}</span>
        @endif
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
    </div>
</div>
<div>
    <input type="checkbox"
        id="task_detail_{{ $task->id }}"
        class="modal-toggle" />
    <x-task-details :task=$task
        :team=$team />
</div>
<script>
    function openTaskDetail(id) {
        event.stopPropagation();
        document.getElementById('task_detail_' + id).checked = true;
        console.log('open');
    }
</script>
