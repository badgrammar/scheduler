<div class="modal" role="dialog">
    <div class="modal-box p-4 space-y-3">
        <h3 class="font-semibold">Edit task</h3>
        <form action="{{route('tasks.plan')}}" method="POST" class="space-y-3">
            @csrf
            <input type="date" name="date" value="{{$task->tanggal}}">
            <input type="hidden" name="id" value="{{$task->id}}">
            <div class="space-x-3 flex justify-end">
                <label for="taskPlan_{{$task->id}}" class="rounded cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 text-xs">Batal</label>
                <button class="rounded cursor-pointer bg-gray-800 text-gray-200 px-4 py-2 text-xs">Update</button>
            </div>
        </form>
    </div>          
</div>