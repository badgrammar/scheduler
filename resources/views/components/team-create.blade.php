<div class="modal"
    role="dialog">
    <div class="modal-box flex flex-col gap-3">
        <div class="font-semibold">Add team member</div>
        <form action="{{ route('tasks.assign') }}"
            method="POST"
            class="flex flex-col gap-3">
            @csrf
            <select name="teknisi"
                class="rounded border border-gray-200 px-4 py-2">
                <option>--Pilih teknisi--</option>
                @foreach ($teknisis as $teknisi)
                    <option value="{{ $teknisi->id }}">{{ $teknisi->name }}</option>
                @endforeach
            </select>
            <input type="hidden"
                name="team_id"
                value="{{ $team->id }}" />
            <input type="hidden"
                name="tanggal"
                value="{{ $date }}" />
            <div class="flex w-full justify-end gap-3">
                <label for="assign_task_{{ $team->id }}"
                    class="cursor-pointer rounded bg-gray-200 px-4 py-2 text-xs text-gray-800">Batal</label>
                <button class="cursor-pointer rounded bg-slate-800 px-4 py-2 text-xs text-white">
                    Assign
                </button>
            </div>
        </form>
    </div>
</div>
