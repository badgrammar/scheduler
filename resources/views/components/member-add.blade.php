<div class="modal"
    role="dialog">
    <div class="modal-box">
        <div>
            <span class="text-lg font-semibold">Add member</span>
        </div>
        <form action="{{ route('team.member.store') }}"
            method="POST"
            class="mt-3 space-y-3">
            @csrf
            <select name="teknisi"
                class="w-full rounded border border-gray-200 px-3 py-2">
                @foreach ($teknisis as $teknisi)
                    <option value="{{ $teknisi->id }}">{{ $teknisi->nama }}</option>
                @endforeach
            </select>
            <div class="flex flex-col gap-3">
                @foreach ($team->members as $item)
                    <div class="flex items-center justify-between rounded bg-gray-100 px-3 py-2">
                        <div>
                            <span>{{ $item->panggilan }}</span>
                        </div>
                        <div>
                            <span class="material-symbols-rounded">close</span>
                        </div>
                    </div>
                @endforeach

            </div>
            <input type="hidden"
                name="team_id"
                value="{{ $team->id }}" />
            <div class="flex justify-end space-x-3">
                <label for="member_add_{{ $team->id }}"
                    class="cursor-pointer rounded bg-gray-200 px-6 py-2 text-gray-800">Cancel</label>
                <button class="cursor-pointer rounded bg-slate-800 px-6 py-2 text-white">Add</button>
            </div>
        </form>
    </div>
</div>
