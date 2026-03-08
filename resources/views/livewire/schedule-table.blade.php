<div class="flex h-full flex-1 flex-col overflow-hidden">
    <div class="flex border-b border-gray-200 p-3">
        <ul class="flex space-x-6">
            @foreach ($listTeam as $team)
                @if ($selectedTeam === $team->id)
                    <li class="cursor-pointer border-b py-1"
                        wire:click="selectTeam({{ $team->id }})">
                        Team {{ $loop->iteration }}
                    </li>
                @else
                    <li class="cursor-pointer py-1"
                        wire:click="selectTeam({{ $team->id }})">
                        Team {{ $loop->iteration }}
                    </li>
                @endif
            @endforeach
            <li class="flex cursor-pointer gap-3 py-1"
                wire:click="createTeam">
                <span>+</span>
                <span>Add team</span>
            </li>
        </ul>
    </div>
    <div class="flex h-full flex-1">
        @if (!$selected)
            <div class="mt-48 flex flex-1 flex-col items-center gap-3">
                <div class="text-center text-lg">No team found for today</div>
                <button class="cursor-pointer rounded border border-gray-200 px-3 py-1"
                    wire:click="createTeam">
                    + Add team
                </button>
            </div>
        @else
            <div class="flex-1 overflow-y-auto p-3">
                <x-task-assign :date="$selectedDate" />
                <x-team-tasks-table :tasks="$teamTasks"
                    :team="$selected" />
            </div>
            <div class="flex w-48 flex-col justify-between border-l border-gray-200 p-3">
                <div class="space-y-3">
                    <div class="font-semibold">Members</div>
                    <ul class="flex flex-col gap-3">
                        @foreach ($selected->members as $member)
                            <li class="flex items-center gap-3">
                                <span wire:click=""
                                    class="material-symbols-rounded cursor-pointer"
                                    style="font-size: 14px">delete</span>
                                <span>{{ $member->name }}</span>
                            </li>
                        @endforeach
                        <li>
                            <label for="member_add_{{ $selected->id }}"
                                class="flex cursor-pointer gap-3">
                                <span>+</span>
                                <span>Add member</span>
                            </label>
                            <input type="checkbox"
                                id="member_add_{{ $selected->id }}"
                                class="modal-toggle" />
                            <x-member-add :team="$selected" />
                        </li>
                    </ul>
                </div>
                <div>
                    <button wire:click="deleteTeam({{ $selected->id }})"
                        class="w-full cursor-pointer rounded bg-red-100 px-3 py-1 text-xs text-red-800">
                        Delete team
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
