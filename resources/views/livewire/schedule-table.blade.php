<div class="flex-1 h-full flex flex-col overflow-hidden">
    <div class="flex p-3 border-b border-gray-200">
        <ul class="space-x-6 flex">
            @foreach($listTeam as $team)
                <li class="cursor-pointer" wire:click="selectTeam({{ $team->id }})">Team {{ $loop->iteration }}</li>
            @endforeach
            <li class="cursor-pointer" wire:click="createTeam">+ Add team</li>
        </ul>
    </div>
    <div class="flex-1 flex h-full">
        @if (!$selected)
        <div class="flex-1 flex flex-col items-center mt-48">
            <div class="text-center text-lg">No team found for today</div>
            <button class="cursor-pointer px-3 py-1 border border-gray-200 rounded" wire:click="createTeam">+ Add team</button>
        </div>
        @else
        <div class="flex-1 overflow-y-auto p-3">
            <div>{{ $selectedDate }}</div>
        </div>
        <div class="flex flex-col justify-between w-48 border-l border-gray-200 p-3">
            <div class="space-y-3">
                <div class="font-semibold">Members</div>
                <ul class="flex flex-col gap-3">
                    @foreach ($selected->members as $member)
                    <li class="flex gap-3 items-center">
                        <span wire:click=""" class="material-symbols-rounded cursor-pointer" style="font-size: 14px;">delete</span>
                        <span>{{ $member->name }} {{ $member->id }}</span>
                    </li>    
                    @endforeach
                    <li>
                        <label for="member_add_{{ $selected->id }}" class="cursor-pointer flex gap-3">
                            <span>+</span>
                            <span>Add member</span>
                        </label>
                        <input type="checkbox" id="member_add_{{ $selected->id }}" class="modal-toggle" />
                        <x-member-add :team="$selected" />
                    </li>
                </ul>
            </div>
            <div>
                <button wire:click="deleteTeam({{$selected->id}})" class="cursor-pointer px-3 py-1 text-xs rounded bg-red-100 text-red-800 w-full">
                    Delete team
                </button>
            </div>
        </div>
        @endif
    </div>
</div>