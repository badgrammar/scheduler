<div class="flex h-full flex-1 gap-3 overflow-hidden p-3">
    <div class="flex w-80 flex-col gap-3 rounded bg-gray-50 p-3">
        <div class="font-semibold">
            Pending Tasks
        </div>
        <div class="scrollbar-hide flex flex-1 flex-col gap-3 overflow-y-auto rounded">
            <div class="task-list flex h-full min-h-[400px] w-full flex-col gap-3">
                @foreach ($pending as $task)
                    <x-kanban-card :task="$task"
                        wire:key="{{ $task->id }}"
                        data-task-id="{{ $task->id }}" />
                    <input type="checkbox"
                        id="task_assign_{{ $task->id }}"
                        class="modal-toggle">
                    <x-task-assign :task=$task
                        :date=$selectedDate />
                @endforeach
                <div class="flex-1 bg-amber-100">

                </div>
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
                                <span class="material-symbols-rounded">group</span>
                            </label>
                            <input type="checkbox"
                                id="member_add_{{ $team->id }}"
                                class="modal-toggle">
                            <x-member-add :team="$team" />
                            <button>
                                <span class="material-symbols-rounded text-red-900">delete</span>
                            </button>
                        </div>
                    </div>
                    <div>
                        @foreach ($team->members as $item)
                            <span class="text-xs">{{ $item->panggilan }}{{ $loop->last ? '' : ',' }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="task-list flex h-full min-h-[400px] flex-col gap-3 bg-red-100"
                    data-team-id={{ $team->id }}>
                    @foreach ($team->tasks as $task)
                        <x-kanban-card :task="$task"
                            wire:key="{{ $task->id }}"
                            data-task-id="{{ $task->id }}" />
                        <input type="checkbox"
                            id="task_reschedule_{{ $task->id }}"
                            class="modal-toggle">
                        <x-task-reschedule :task=$task />
                    @endforeach
                    <div class="bg-amber-99 flex-1">

                    </div>
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
                        const newTeamId = evt.to.dataset.teamId;
                        const reschedule = document.getElementById(`task_reschedule_${taskId}`);
                        const assign = document.getElementById(`task_assign_${taskId}`);

                        if (!newTeamId) {
                            if (!reschedule) {
                                return;
                            }

                            reschedule.checked = true;
                            return;
                        } else {
                            if (!assign) {
                                return;
                            }
                            assign.checked = true;
                            return;
                        }

                    }
                });
            });
        }
    </script>
@endscript
