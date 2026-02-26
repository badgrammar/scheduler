<div class="flex h-full flex-1 gap-3 overflow-hidden p-3">
    <div class="flex w-80 flex-col gap-3 rounded bg-gray-50 p-3">
        <div class="font-semibold">
            Pending Tasks
        </div>
        <div class="scrollbar-hide flex flex-1 flex-col gap-3 overflow-y-auto rounded">
            <div class="task-list flex h-full min-h-[400px] w-full flex-col gap-3"
                data-column-type="pending">
                @foreach ($pending as $task)
                    <x-kanban-card :task="$task"
                        wire:key="{{ $task->id }}"
                        data-task-id="{{ $task->id }}" />
                @endforeach
                <div class="flex-1">
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
                            <form action="{{ route('team.delete', ['id' => $team->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden"
                                    name="team_id"
                                    value="{{ $team->id }}">
                                <button>
                                    <span class="material-symbols-rounded text-red-900">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div>
                        @foreach ($team->members as $item)
                            <span class="text-xs">{{ $item->panggilan }}{{ $loop->last ? '' : ',' }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="task-list flex h-full min-h-[400px] flex-col gap-3"
                    data-column-type="team"
                    data-team-id="{{ $team->id }}">
                    @foreach ($team->tasks as $task)
                        <span class="font-semibold">@jam($task->jam)</span>
                        <x-kanban-card :task="$task"
                            :team="$team" />
                    @endforeach
                    <div class="flex-1">
                    </div>
                </div>
            </div>
        @endforeach
        <div class="p-3">
            <button wire:click="createTeam"
                class="w-64 rounded bg-slate-800 py-2 font-semibold text-white">Add Team</button>
        </div>
    </div>
    <input type="checkbox"
        id="task_reschedule"
        class="modal-toggle">
    <x-task-reschedule :task=$task />
    <input type="checkbox"
        id="task_assign"
        class="modal-toggle">
    <x-task-assign />
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
                        const fromType = evt.from.dataset.columnType;
                        const toType = evt.to.dataset.columnType;
                        const taskId = evt.item.dataset.taskId;
                        const jam = document.getElementById('jam').value;

                        if (fromType === 'pending' && toType === 'team') {
                            const teamId = evt.to.dataset.teamId;

                            console.log([$wire.selectedDate, taskId]);

                            document.getElementById('teamId').value = teamId;
                            document.getElementById('taskId').value = taskId;
                            document.getElementById('tanggal').value = $wire.selectedDate;

                            openAssignModal();
                        } else if (fromType === 'team' && toType === 'team') {
                            const newTeamId = evt.to.dataset.teamId;

                            console.log([$wire.selectedDate, taskId]);

                            document.getElementById('teamId').value = newTeamId;
                            document.getElementById('taskId').value = taskId;
                            document.getElementById('tanggal').value = $wire.selectedDate;

                            openAssignModal();
                        } else if (fromType === 'team' && toType === 'pending') {

                            openRescheduleModal();
                        }

                    }
                });
            });
        }

        function openAssignModal() {
            document.getElementById('task_assign').checked = true;
            document.getElementById('jam').focus();
        }

        function closeAssignModal() {
            document.getElementById('task_assign').checked = false;
        }

        function openRescheduleModal() {
            document.getElementById('task_reschedule').checked = true;
        }

        function closeRescheduleModal() {
            document.getElementById('task_reschedule').checked = false;
        }
    </script>
@endscript
