<div class="modal" role="dialog">
    <div class="modal-box p-4 space-y-3">
        <h3 class="font-semibold">Edit task</h3>
        <form action="{{route('teknisi.update')}}" class="space-y-3">
            @csrf
            <input type="text" name="tujuan" placeholder="Tujuan" value="{{$teknisi->name}}" class="px-4 py-2 w-full border border-gray-200"/>
            <input type="hidden" name="id" value="{{$teknisi->id}}">
            <select name="divisi" class="px-4 py-2 w-full border border-gray-200">
                <option>Divisi</option>
                <option value="fop" {{ $teknisi->divisi === 'fop' ? 'selected' : '' }}>FOP</option>
                <option value="cft" {{ $teknisi->divisi === 'cft' ? 'selected' : '' }}>CFT</option>
                <option value="noc" {{ $teknisi->divisi === 'noc' ? 'selected' : '' }}>NOC</option>
            </select>
            <div class="space-x-3 flex justify-end">
                <label for="teknisiEdit_{{$teknisi->id}}" class="rounded cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 text-xs">Batal</label>
                <button class="rounded cursor-pointer bg-gray-800 text-gray-200 px-4 py-2 text-xs">Update</button>
            </div>
        </form>
    </div>          
</div>