<div class="space-y-3">
    <div class="border border-gray-200 p-3 flex justify-between items-center">
        <div class="font-semibold">Teknisi list</div>
        <div>
            <label for="teknisiCreate" class="rounded cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 text-xs">+ Create</label>
            <input type="checkbox" id="taskCreate" class="modal-toggle"/>
            
        </div>
    </div>
    <table class="table table-sm table-pin-rows table-pin-cols border border-gray-200 rounded-none">
        <tr class="font-semibold">
            <td>Nama</td>
            <td>Divisi</td>
        </tr>
        @foreach($teknisis as $teknisi)
            <tr>
                <td>{{ $teknisi->name }}</td>
                <td>{{ $teknisi->divisi }}</td>
            </tr>
        @endforeach
    </table>
</div>