<div class="modal" role="dialog">
    <div class="modal-box p-4 space-y-3">
        <h3 class="font-semibold">Reschedule task</h3>
        <form
            action="{{ route('tasks.reschedule') }}"
            method="POST"
            class="space-y-3"
        >
            @csrf
            <div class="flex justify-between items-center">
                <div>{{$task->tujuan}} | {{$task->pekerjaan}}</div>
                <input
                    type="date"
                    name="tanggal"
                    class="w-fit border border-gray-200 px-3 py-1"
                />
            </div>
            <div class="flex flex-col gap-3">
                <input type="hidden" name="id" value="{{$task->id}}" />
                <div class="font-semibold">Keterangan</div>
                <textarea
                    type="text"
                    name="keterangan"
                    class="border border-gray-200 px-3 py-1 h-16"
                ></textarea>
            </div>
            <div class="space-x-3 flex justify-end">
                <label
                    for="taskReschedule_{{$task->id}}"
                    class="rounded cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 text-xs"
                    >Batal</label
                >
                <button
                    class="rounded cursor-pointer bg-gray-800 text-gray-200 px-4 py-2 text-xs"
                >
                    Reschedule
                </button>
            </div>
        </form>
    </div>
</div>
