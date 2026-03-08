<div class="modal"
    {{ $attributes }}
    role="dialog"
    id="task-assign"
    x-data="{ taskId: '', teamId: '', tanggal: '', jam: '', tujuan: '', pekerjaan: '' }">
    <div class="modal-box flex flex-col gap-3"
        style="width:240px;">
        <div>
            <span class="font-semibold">Jam penjadwalan</span>
            <input type="text"
                class="mt-3 w-full rounded border border-gray-200 px-3 py-2"
                name="jam"
                id="jam"
                x-model="jam" />
        </div>
        <div class="flex justify-end gap-3">
            <button type="submit"
                class="rounded bg-gray-200 px-6 py-2 text-gray-800"
                onclick="closeAssignModal()">Cancel</button>
            <button class="rounded bg-slate-800 px-6 py-2 text-white"
                x-on:click="$wire.assign(taskId,teamId,tanggal,jam)"
                onclick="doneAssignModal()">Assign</button>
        </div>
    </div>
</div>
<script>
    function doneAssignModal() {
        document.getElementById('task_assign').checked = false;
    }
</script>
