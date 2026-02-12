<div class="modal"
    role="dialog">
    <div class="modal-box flex flex-col gap-3">
        <form action="{{ route('tasks.assign') }}"
            method="POST">
            @csrf
            @method('patch')
            <div>
                <span class="bold">Jam penjadwalan</span>
                <input type="hidden"
                    name="date"
                    value="{{ $date }}">
                <input type="hidden"
                    name="taskId"
                    value="{{ $task->id }}">
                <input type="text"
                    class="rounded border border-gray-200 px-3 py-1"
                    name="jam" />
            </div>
            <div class="flex justify-end gap-3">
                <button type="submit"
                    class="bg-gray-200 px-3 py-1 text-gray-800">Cancel</button>
                <button type="button"
                    class="bg-slate-800 px-3 py-1 text-white">Assign</button>
            </div>
        </form>
    </div>
</div>
