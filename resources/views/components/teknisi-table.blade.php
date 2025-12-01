<div class="space-y-3">
    <div class="border border-gray-200 p-3 flex justify-between items-center">
        <div class="font-semibold">Teknisi list</div>
        <div>
            <label for="teknisiCreate" class="rounded cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 text-xs">+ Create</label>
            <input type="checkbox" id="teknisiCreate" class="modal-toggle"/>
            <x-teknisi-create/>
        </div>
    </div>
    <table class="table table-sm table-pin-rows table-pin-cols border border-gray-200 rounded-none">
        <tr class="font-semibold">
            <td>Nama</td>
            <td>Divisi</td>
            <td></td>
        </tr>
        @foreach($teknisis as $teknisi)
            <tr>
                <td>{{ $teknisi->name }}</td>
                <td class="uppercase">{{ $teknisi->divisi }}</td>
                <td class="flex gap-1 items-center">
                    <div>
                        <label for="teknisiEdit_{{$teknisi->id}}" class="cursor-pointer">
                            <span class="material-symbols-rounded text-slate-800" style="font-size: 18px;">edit_square</span>
                        </label>
                        <input type="checkbox" id="teknisiEdit_{{$teknisi->id}}" class="modal-toggle"/>
                        <x-teknisi-edit :$teknisi/>
                    </div>
                    <a href="{{route('teknisi.delete', ['id' => $teknisi->id])}}">
                        <span class="material-symbols-rounded text-red-800">delete</span>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
</div>