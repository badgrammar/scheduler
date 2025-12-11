<div class="modal" role="dialog">
    <div class="modal-box">
        <div> 
            <span class="font-semibold text-lg">Add member</span>
        </div>
        <form action="{{ route('team.member.store') }}" method="POST" class="mt-3 space-y-3">
            @csrf
            <select name="teknisi" class="w-full border border-gray-200 rounded py-2 px-3">
                @foreach ($teknisis as $teknisi)
                    <option value="{{ $teknisi->id }}">{{ $teknisi->name }}</option>
                @endforeach
            </select>
            <input type="hidden" name="team_id" value="{{ $team->id }}"/>
            <div class="flex justify-end space-x-3">
                <label for="member_add_{{ $team->id }}" class="bg-gray-200 text-gray-800 rounded cursor-pointer px-6 py-2">Cancel</label>
                <button class="bg-slate-800 text-white rounded cursor-pointer px-6 py-2">Add</button>
            </div>
        </form>
    </div>
</div>