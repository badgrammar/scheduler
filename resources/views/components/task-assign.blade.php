<div class="modal"
    {{ $attributes }}
    role="dialog"
    id="task-assign"
    x-data="{ taskId: 'this is task id', teamId: 'this is team id', tanggal: 'this is tanggal' }">
    <div class="modal-box flex flex-col gap-3"
        style="width:240px;">
        <div>
            <span class="font-semibold">Jam penjadwalan</span>
            <input type="text"
                class="mt-3 w-full rounded border border-gray-200 px-3 py-2"
                name="jam"
                id="jam" />
            <span x-text="taskId"></span>
            <span x-text="teamId"></span>
            <span x-text="tanggal"></span>
        </div>
        <h1 x-data="{ message: 'test alpine' }"
            x-text="message"></h1>
        <div class="flex justify-end gap-3">
            <button type="submit"
                class="rounded bg-gray-200 px-6 py-2 text-gray-800"
                onclick="closeAssignModal()">Cancel</button>
            <button class="rounded bg-slate-800 px-6 py-2 text-white">Assign</button>
        </div>
    </div>
</div>
<script>
    function closeAssignModal() {
        document.getElementById('task_assign').checked = false;
    }
</script>
