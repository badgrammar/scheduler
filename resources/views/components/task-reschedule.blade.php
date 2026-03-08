<div class="modal"
    role="dialog"
    id="task-reschedule"
    x-data="{ taskId: '', keterangan: '', tanggal: '', tujuan: '', pekerjaan: '' }">
    <div class="modal-box space-y-3 p-4">
        <div class="flex flex-col gap-3">
            <div class="flex items-end justify-between">
                <div class="font-semibold">Reschedule</div>
                <div class="rounded px-4 py-1 text-xs font-semibold text-gray-400"
                    x-text="'Task #'+taskId"></div>
            </div>
            <div class="flex flex-col gap-2">
                <div class="flex gap-2">
                    <div class="text-red-600">
                        <span class="material-symbols-rounded">location_on</span>
                    </div>
                    <div>
                        <span x-text="tujuan"></span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <div class="text-slate-600">
                        <span class="material-symbols-rounded">assignment</span>
                    </div>
                    <div>
                        <span x-text="pekerjaan"></span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <div class="flex flex-col gap-3">
                    <div class="font-semibold">Tanggal</div>
                    <input type="date"
                        id="tanggal"
                        class="w-full rounded border border-gray-200 px-3 py-2"
                        x-model="tanggal" />
                </div>
                <div class="flex flex-col gap-3">
                    <div class="font-semibold">Keterangan <span
                            class="text-xs font-medium text-gray-400">(opsional)</span></div>
                    <textarea type="text"
                        class="h-16 rounded border border-gray-200 px-3 py-2"
                        x-model="keterangan"
                        id="keterangan"
                        placeholder="Tambahkan keterangan atau note reschedule"></textarea>
                </div>
                <div class="flex justify-between space-x-3">
                    <div>
                    </div>
                    <div class="flex space-x-3">
                        <button type="submit"
                            class="cursor-pointer rounded bg-gray-200 px-4 py-2 text-xs text-gray-800"
                            onclick="closeRescheduleModal()">Batal</button>
                        <button class="cursor-pointer rounded bg-gray-800 px-4 py-2 text-xs text-gray-200"
                            x-on:click="$wire.reschedule(taskId,tanggal,keterangan)"
                            onclick="doneRescheduleModal()">
                            Reschedule
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function doneRescheduleModal() {
            document.getElementById('task_reschedule').checked = false;
        }
    </script>
