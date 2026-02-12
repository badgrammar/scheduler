<div class="modal"
    role="dialog">
    <div class="modal-box space-y-3 p-4">
        <h3 class="font-semibold">Reschedule task</h3>
        <form action="{{ route('tasks.reschedule') }}"
            method="POST"
            class="space-y-3">
            @csrf
            <div class="flex flex-col items-start">
                <div>{{ $task->tujuan }}</div>
                <div>
                    {{ $task->pekerjaan }}
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <input type="hidden"
                    name="id"
                    value="{{ $task->id }}" />
                <div class="font-semibold">Keterangan</div>
                <textarea type="text"
                    name="keterangan"
                    class="h-16 border border-gray-200 px-3 py-1"></textarea>
            </div>
            <div class="flex justify-between space-x-3">
                <div>
                    <input type="date"
                        name="tanggal"
                        class="w-fit border border-gray-200 px-3 py-1" />
                </div>
                <div class="flex space-x-3">
                    <label for="task_reschedule_{{ $task->id }}"
                        class="cursor-pointer rounded bg-gray-200 px-4 py-2 text-xs text-gray-800">Batal</label>
                    <button class="cursor-pointer rounded bg-gray-800 px-4 py-2 text-xs text-gray-200">
                        Reschedule
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
