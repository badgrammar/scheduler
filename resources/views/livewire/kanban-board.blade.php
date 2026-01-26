<div class="flex h-full flex-1 gap-3 overflow-hidden p-3">
    <div class="flex w-64 flex-col gap-3 rounded bg-slate-50 p-3">
        <div class="font-semibold">
            Pending Tasks
        </div>
        <div class="flex flex-col gap-3">
            @foreach ($pending as $item)
                <div class="flex flex-col gap-1 rounded border border-slate-200 bg-white p-3">
                    <div class="flex flex-col gap-2">
                        <div class="w-fit rounded bg-blue-200 px-2 text-xs text-blue-800">
                            {{ $item->prioritas }}
                        </div>
                        <div class="font-semibold">
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
    @foreach ($teams as $team)
        <div class="flex w-64 flex-col gap-3 rounded bg-slate-50 p-3">
            <div class="flex justify-between font-semibold">
                <div>
                    <span>Team {{ $loop->iteration }}</span>
                </div>
                <div>
                    <label for="member_add_{{ $team->id }}"
                        class="text-underline cursor-pointer rounded px-3 py-1 text-xs font-medium">Add
                        member</label>
                    <input type="checkbox"
                        id="member_add_{{ $team->id }}"
                        class="modal-toggle" />
                    <x-member-add :team="$team" />
                </div>
            </div>
            <div class="flex flex-col gap-3">
                @foreach ($team->tasks as $task)
                    <div class="flex flex-col gap-1 rounded border border-slate-200 bg-white p-3">
                        <div class="flex flex-col gap-2">
                            <div class="w-fit rounded bg-blue-200 px-2 text-xs text-blue-800">
                                {{ $task->prioritas }}
                            </div>
                            <div class="font-semibold">
                                {{ $task->tujuan }}
                            </div>
                        </div>
                        <div>
                            <span class="text-xs">{{ $task->pekerjaan }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    <div>
        <button wire:click="createTeam"
            class="w-64 rounded bg-slate-50 py-2 font-semibold">Add Team</button>
    </div>
</div>
