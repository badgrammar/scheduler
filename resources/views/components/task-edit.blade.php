<div class="modal" role="dialog">
    <div class="modal-box p-4 space-y-3">
        <h3 class="font-semibold">Edit task</h3>
        <form action="{{route('tasks.update')}}" method="POST" class="space-y-3">
            @csrf
            <input type="text" name="tujuan" placeholder="Tujuan" value="{{$task->tujuan}}" class="px-4 py-2 w-full border border-gray-200"/>
            <input type="text" name="pekerjaan" placeholder="Pekerjaan" value="{{$task->pekerjaan}}" class="px-4 py-2 w-full border border-gray-200"/>
            <input type="text" name="keterangan" placeholder="Keterangan" value="{{$task->keterangan}}" class="px-4 py-2 w-full h-fit border border-gray-200"/>
            <input type="hidden" name="id" value="{{$task->id}}">
            <select name="prioritas" class="px-4 py-2 w-full border border-gray-200">
                <option>Prioritas</option>
                <option value="normal">Normal</option>
                <option value="high">High</option>
            </select>
            <div class="space-x-3 flex justify-end">
                <label for="taskEdit" class="rounded cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 text-xs">Batal</label>
                <button class="rounded cursor-pointer bg-gray-800 text-gray-200 px-4 py-2 text-xs">Create</button>
            </div>
        </form>
    </div>          
</div>