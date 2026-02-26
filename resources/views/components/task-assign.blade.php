<div class="modal"
    {{ $attributes }}
    role="dialog">
    <div class="modal-box flex flex-col gap-3"
        style="width:240px;">
        <form action="{{ route('tasks.assign') }}"
            class="space-y-3"
            method="POST">
            @csrf
            @method('patch')
            <div>
                <span class="font-semibold">Jam penjadwalan</span>
                <input type="hidden"
                    name="tanggal"
                    id="tanggal">
                <input type="hidden"
                    name="taskId"
                    id="taskId">
                <input type="hidden"
                    name="teamId"
                    id="teamId">
                <input type="text"
                    class="mt-3 w-full rounded border border-gray-200 px-3 py-2"
                    name="jam"
                    id="jam"
                    autofocus />
            </div>
            <div class="flex justify-end gap-3">
                <button type="submit"
                    class="rounded bg-gray-200 px-6 py-2 text-gray-800"
                    onclick="closeAssignModal()">Cancel</button>
                <button class="rounded bg-slate-800 px-6 py-2 text-white">Assign</button>
            </div>
        </form>
    </div>
</div>
<script>
    function closeAssignModal() {
        document.getElementById('task_assign').checked = false;
    }
</script>
