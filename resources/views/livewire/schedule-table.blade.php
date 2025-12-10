<div>
    <div class="flex p-3 border-b border-gray-200">
        {{$this->selectedDate}}
        <ul class="space-x-3 flex">
            @foreach($teams as $team)
                <li>Team {{$team->id}}</li>
            @endforeach
            <li class="cursor-pointer" wire:click="createTeam">+Add team</li>
        </ul>
    </div>
</div>