<div class="flex-1 h-full flex flex-col overflow-hidden">
    <div class="flex p-3 border-b border-gray-200">
        <ul class="space-x-3 flex">
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
            <div>Tasks table</div>
        </div>
        <div class="flex flex-col justify-between w-48 border-l border-gray-200 p-3">
            <div>
                <div>Members</div>
                <ul>
                    @foreach ($selected->members as $member)
                    <li>{{ $member->name }}</li>    
                    @endforeach
                </ul>
            </div>
            <div>
                <button class="cursor-pointer px-3 py-1 text-xs rounded bg-red-100 text-red-800 w-full">
                    Delete team
                </button>
            </div>
        </div>
        @endif
    </div>
</div>