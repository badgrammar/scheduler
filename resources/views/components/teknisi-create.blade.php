<div class="modal" role="dialog">
    <div class="modal-box p-4 space-y-3">
        <h3 class="font-semibold">Create teknisi</h3>
        <form action="{{route('teknisi.store')}}" method="POST" class="space-y-3">
            @csrf
            @error('nama')
                <div class="text-red-400 text-xs">{{ $message }}</div>
            @enderror
            <input type="text" name="name" placeholder="Nama teknisi" class="px-4 py-2 w-full border border-gray-200"/>
            @error('divisi')
                <div class="text-red-400 text-xs">{{ $message }}</div>
            @enderror
            <select name="divisi" class="px-4 py-2 w-full border border-gray-200">
                <option>Divisi</option>
                <option value="fop">FOP</option>
                <option value="cft">CFT</option>
                <option value="noc">NOC</option>
            </select>
            <div class="space-x-3 flex justify-end">
                <label for="teknisiCreate" class="rounded cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 text-xs">Batal</label>
                <button class="rounded cursor-pointer bg-gray-800 text-gray-200 px-4 py-2 text-xs">Create</button>
            </div>
        </form>
    </div>          
</div>