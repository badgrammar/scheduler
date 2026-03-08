<div class="flex h-full flex-1 gap-3 overflow-hidden p-3">
    <div class="flex w-80 flex-col gap-3 rounded bg-gray-50 p-3">
        <div class="font-semibold">
            Pending Tasks
        </div>
        <div class="scrollbar-hide flex flex-1 flex-col gap-3 overflow-y-auto rounded">
            <div class="task-list flex h-full min-h-[400px] w-full flex-col gap-3"
                data-column-type="pending">
                @forelse ($pending as $task)
                    <x-kanban-card :task="$task"
                        wire:key="{{ $task->id }}"
                        data-task-id="{{ $task->id }}"
                        data-task-tujuan="{{ $task->tujuan }}"
                        data-task-pekerjaan="{{ $task->pekerjaan }}" />
                @empty
                    <div class="w-full rounded bg-white p-3">
                        <span>No pending tasks</span>
                    </div>
                @endforelse
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
                            :team="$team"
                            data-task-id="{{ $task->id }}"
                            data-task-tujuan="{{ $task->tujuan }}"
                            data-task-pekerjaan="{{ $task->pekerjaan }}" />
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
    <x-task-reschedule />
    <input type="checkbox"
        id="task_assign"
        class="modal-toggle">
    <x-task-assign />
</div>
<script>
    var taskData = null;

    function closeAssignModal() {
        if (!taskData) {
            console.log('task data empty');
            return;
        }

        const parent = taskData.fromList;
        const item = taskData.item;
        const next = taskData.nextElement;

        if (next && next.parentNode === parent) {
            parent.insertBefore(item, next);
        } else {
            console.log(parent);
            parent.appendChild(item);
        }

        taskData = null;

        document.getElementById('task_assign').checked = false;
    }

    function closeRescheduleModal() {
        if (!taskData) {
            console.log('task data empty');
            return;
        }

        const parent = taskData.fromList;
        const item = taskData.item;
        const next = taskData.nextElement;

        if (next && next.parentNode === parent) {
            parent.insertBefore(item, next);
        } else {
            console.log(parent);
            parent.appendChild(item);
        }

        taskData = null;

        document.getElementById('task_reschedule').checked = false;
    }
</script>
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
                    onStart: function(evt) {
                        taskData = {
                            item: evt.item,
                            fromList: evt.from,
                            nextElement: evt.item.nextElementSibling
                        };
                    },
                    onEnd: function(evt) {
                        const fromType = evt.from.dataset.columnType;
                        const toType = evt.to.dataset.columnType;
                        const taskId = evt.item.dataset.taskId;
                        const tujuan = evt.item.dataset.taskTujuan;
                        const pekerjaan = evt.item.dataset.taskPekerjaan;

                        if (fromType === 'pending' && toType === 'team') {
                            const teamId = evt.to.dataset.teamId;

                            openAssignModal(taskId, teamId, $wire.selectedDate);
                        } else if (fromType === 'team' && toType === 'team') {
                            const newTeamId = evt.to.dataset.teamId;

                            openAssignModal(taskId, newTeamId, $wire.selectedDate);
                        } else if (fromType === 'team' && toType === 'pending') {
                            openRescheduleModal(taskId, tujuan, pekerjaan);
                        }

                    }
                });
            });
        }

        function openAssignModal(taskId, teamId, tanggal) {
            modalAssign = document.getElementById('task-assign');

            Alpine.$data(modalAssign).taskId = taskId;
            Alpine.$data(modalAssign).teamId = teamId;
            Alpine.$data(modalAssign).tanggal = tanggal;

            document.getElementById('task_assign').checked = true;
            document.getElementById('jam').focus();
        }

        function openRescheduleModal(taskId, tujuan, pekerjaan) {
            modalReschedule = document.getElementById('task-reschedule');

            Alpine.$data(modalReschedule).taskId = taskId;
            Alpine.$data(modalReschedule).tujuan = tujuan;
            Alpine.$data(modalReschedule).pekerjaan = pekerjaan;

            document.getElementById('task_reschedule').checked = true;
            document.getElementById('tanggal').focus();
        }
    </script>
@endscript
