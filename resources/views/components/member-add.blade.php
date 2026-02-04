<div class="modal"
    role="dialog">
    <div class="modal-box">
        <div>
            <span class="text-lg font-semibold">Team member</span>
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

            <div class="flex justify-end space-x-3">
                <label for="member_add_{{ $team->id }}"
                    class="cursor-pointer rounded bg-gray-200 px-6 py-2 text-gray-800">Cancel</label>
                <button class="cursor-pointer rounded bg-slate-800 px-6 py-2 text-white">Add</button>
            </div>
        </form>
        <div class="mt-3 flex flex-col gap-3">
            @foreach ($team->members as $item)
                <div class="flex items-center justify-between rounded bg-gray-100 px-3 py-2">
                    <div>
                        <span>{{ $item->panggilan }}</span>
                    </div>
                    <div>
                        <form action="{{ route('team.member.delete') }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden"
                                name="id"
                                value="{{ $item->id }}">
                            <button type="submit"
                                class="material-symbols-rounded">close</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
