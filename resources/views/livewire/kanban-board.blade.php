<div class="flex h-full flex-1 gap-3 overflow-hidden p-3">
    <div class="flex w-80 flex-col gap-3 rounded bg-gray-50 p-3">
        <div class="font-semibold">
            Pending Tasks
        </div>
        <div class="scrollbar-hide flex flex-1 flex-col gap-3 overflow-y-auto rounded">
            <div class="flex w-full flex-col gap-3">
                @foreach ($pending as $item)
                    <div class="flex w-full flex-col gap-3 rounded bg-white p-3">
                        <div>
                            <div>
                                {{ $item->tujuan }}
                            </div>
                            <div>
                                <span class="text-xs">{{ $item->pekerjaan }}</span>
                            </div>
                        </div>
                        <div class="flex gap-3 text-xs">
                            @if ($item->prioritas === 'normal')
                                <span
                                    class="w-fit rounded-xl bg-gray-200 px-4 text-gray-800">{{ $item->prioritas }}</span>
                            @elseif($item->prioritas === 'high')
                                <span class="w-fit rounded-xl bg-red-200 px-4 text-red-800">{{ $item->prioritas }}</span>
                            @endif
                            @switch($item->status)
                                @case('pending')
                                    <span class="rounded-xl bg-yellow-200 px-4 text-yellow-800">{{ $item->status }}</span>
                                @break

                                @case('rescheduled')
                                    <span class="rounded-xl bg-gray-200 px-4 text-gray-800">{{ $item->status }}</span>
                                @break

                                @case('assigned')
                                    <span class="rounded-xl bg-blue-200 px-4 text-blue-800">{{ $item->status }}</span>
                                @break

                                @case('confirmed')
                                    <span class="rounded-xl bg-green-200 px-4 text-green-800">{{ $item->status }}</span>
                                @break

                                @case('closed')
                                    <span class="rounded-xl bg-gray-200 px-4 text-gray-800">{{ $item->status }}</span>
                                @break

                                @case('canceled')
                                    <span class="rounded-xl bg-red-200 px-4 text-red-800">{{ $item->status }}</span>
                                @break
                            @endswitch
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex flex-1 gap-3 overflow-x-auto">
        @foreach ($teams as $team)
            <div class="flex w-80 min-w-80 flex-col gap-3 rounded bg-gray-50 p-3">
                <div class="flex flex-col gap-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="font-semibold">Team {{ $loop->iteration }}</span>
                        </div>
                        <div class="flex items-center">
                            <label for="member_add_{{ $team->id }}"
                                class="cursor-pointer rounded px-3 py-1 text-xs underline">
                                <span class="material-symbols-rounded">person_add</span>
                            </label>
                            <button>
                                <span class="material-symbols-rounded text-red-900">delete</span>
                            </button>
                            <button wire:click="openTask({{}})"></button>
                            <livewire:member-manage :team="$team" />
                        </div>
                    </div>
                    <div>
                        @foreach ($team->members as $item)
                            <span class="text-xs">{{ $item->panggilan }}{{ $loop->last ? '' : ',' }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    @foreach ($team->tasks as $task)
                        <div class="flex flex-col gap-1 rounded border border-slate-200 bg-white p-3">
                            <div>
                                <div>
                                    {{ $task->tujuan }}
                                </div>
                                <span class="text-xs">{{ $task->pekerjaan }}</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                @if ($task->prioritas === 'normal')
                                    <span
                                        class="rounded-xl bg-gray-200 px-4 text-gray-800">{{ $task->prioritas }}</span>
                                @elseif($task->prioritas === 'high')
                                    <span class="rounded-xl bg-red-200 px-4 text-red-800">{{ $task->prioritas }}</span>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <div class="p-3">
            <button wire:click="createTeam"
                class="w-64 rounded bg-slate-800 py-2 font-semibold text-white">Add Team</button>
        </div>

    </div>
</div>

@script
    <script>
        initializeSortable();

        Livewire.hook('morph.updated', () => {
            initializeSortable();
        });

        function initializeSortable() {
            const taskLists = document.querySelectorAll('.task-list');

            taskLists.forEach(list => {
                if (list.sortable) {
                    list.sortable.destroy();
                }

                list.sortable = new Sortable(list, {
                    animation: 150,
                    sort: false,
                    group: 'tasks',
                    onEnd: function(evt) {
                        const taskId = evt.item.dataset.taskId;
                        const newColumnId = evt.to.dataset.columnId;

                        $wire.dispatch('task-moved', {
                            taskId: taskId,
                            newColumnId: newColumnId
                        });
                    }
                });
            });
        }
    </script>
@endscript
