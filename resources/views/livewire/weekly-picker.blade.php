<div class="p-3 flex justify-between border-b border-gray-200">
    <div class="flex space-x-3 items-center">
        <button wire:click="prevWeek">
            <span class="material-symbols-rounded">arrow_left</span>
        </button>
        <div>
            <span>@bulan($date)</span>
            <span>@tahun($date)</span>
        </div>
        <button wire:click="nextWeek">
            <span class="material-symbols-rounded">arrow_right</span>
        </button>
    </div>
    <div class="flex space-x-3">
        @foreach($week as $day)
            @if($this->selectedDate === $day)
            <div wire:click="selectDate('{{$day}}')" class="flex flex-col items-center bg-gray-100 p-1 rounded cursor-pointer" style="font-size: 10px">
                <span>@hari($day)</span>
                <span>@namahari($day)</span>
            </div>
            @else
            <div wire:click="selectDate('{{$day}}')" class="flex flex-col items-center p-1 rounded cursor-pointer" style="font-size: 10px">
                <span>@hari($day)</span>
                <span>@namahari($day)</span>
            </div>
            @endif
        @endforeach
    </div>
</div>
