<div class="modal" role="dialog">
    <div
        class="modal-box flex flex-col gap-3"
        style="width: 1024px; max-width: 1024px"
    >
        <div class="font-semibold">Assign Task</div>
        <form
            action="{{ route('tasks.assign') }}"
            method="POST"
            class="flex flex-col gap-3"
        >
            @csrf
            <select name="task_id">
                @foreach($tasks as $task)
                <option value="{{$task->id}}">
                    {{ $task->tujuan }} | {{ $task->pekerjaan }}
                </option>
                @endforeach
            </select>
            <div class="flex gap-3 items-center">
                <div>Jam visit :</div>
                <input
                    class="rounded border border-gray-200 px-3 py-1"
                    type="time"
                    name="jam"
                />
            </div>
            <input type="hidden" name="team_id" value="{{$team->id}}" />
            <div class="w-full flex justify-end gap-3">
                <label
                    for="assign_task_{{$team->id}}"
                    class="rounded cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 text-xs"
                    >Batal</label
                >
                <button
                    class="cursor-pointer rounded bg-slate-800 text-white text-xs px-4 py-2"
                >
                    Assign
                </button>
            </div>
        </form>
    </div>
</div>
