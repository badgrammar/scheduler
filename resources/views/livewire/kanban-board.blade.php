<div class="flex h-full flex-1 gap-3 overflow-hidden bg-gray-100">
    <div class="flex w-80 flex-col gap-3 p-3">
        <div class="rounded bg-white p-3 font-semibold">
            Pending Tasks
        </div>
        <div class="scrollbar-hide flex flex-1 flex-col gap-3 overflow-y-auto rounded">
            @if ($today->isNotEmpty())
                <div class="flex flex-col gap-3">
                    <div>
                        <span class="text-xs">Rescheduled today</span>
                    </div>
                    @foreach ($today as $item)
                        <div class="flex w-full flex-col gap-3 rounded bg-white p-3">
                            <div>
                                <div>
                                    {{ $item->tujuan }}
                                </div>
                                <span class="text-xs">{{ $item->pekerjaan }}</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                @if ($item->prioritas === 'normal')
                                    <span
                                        class="w-fit rounded-xl bg-gray-200 px-4 text-xs text-gray-800">{{ $item->prioritas }}</span>
                                @elseif($item->prioritas === 'high')
                                    <span
                                        class="w-fit rounded-xl bg-red-200 px-4 text-xs text-red-800">{{ $item->prioritas }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="flex w-full flex-col gap-3">
                <div>
                    <span class="text-xs">Not scheduled</span>
                </div>
                @foreach ($pending as $item)
                    <div class="flex w-full flex-col gap-1 rounded bg-white p-3">
                        <div class="flex flex-col gap-2">
                            @if ($item->prioritas === 'normal')
                                <span
                                    class="w-fit rounded-xl bg-gray-200 px-4 text-xs text-gray-800">{{ $item->prioritas }}</span>
                            @elseif($item->prioritas === 'high')
                                <span
                                    class="w-fit rounded-xl bg-red-200 px-4 text-xs text-red-800">{{ $item->prioritas }}</span>
                            @endif
                            <div>
                                {{ $item->tujuan }}
                            </div>
                        </div>
                        <div>
                            <span class="text-xs">{{ $item->pekerjaan }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex flex-1 gap-3 overflow-x-auto">
        @foreach ($teams as $team)
            <div class="flex w-80 min-w-80 flex-col gap-3 p-3">
                <div class="flex flex-col gap-1 rounded bg-white p-3">
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
                            <input type="checkbox"
                                id="member_add_{{ $team->id }}"
                                class="modal-toggle" />
                            <x-member-add :team="$team" />
                        </div>
                    </div>
                    <div>
                        <span>[</span>
                        @foreach ($team->members as $item)
                            <span class="text-xs">{{ $item->panggilan }}{{ $loop->last ? '' : ',' }}</span>
                        @endforeach
                        <span>]</span>
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
