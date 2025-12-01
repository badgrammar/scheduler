<x-authentication>
    <div class="p-4 space-y-4">
        <div>Register</div>
        <form action="{{route('auth.register')}}" class="space-y-4" method="POST">
            @csrf
            <div>
                @error('name')
                    <div class="text-red-400 text-xs">{{ $message }}</div>
                @enderror
                <input type="text" name="name" class="border px-4 py-2" placeholder="Name">
            </div>
            <div>
                @error('email')
                    <div class="text-red-400 text-xs">{{ $message }}</div>
                @enderror
                <input type="text" name="email" class="border px-4 py-2" placeholder="Email">
            </div>
            <div>
                @error('role')
                    <div class="text-red-400 text-xs">{{ $message }}</div>
                @enderror
                <select name="role" class="px-4 py-2 border w-full">
                    <option>Role</option>
                    @foreach(App\Enums\Roles::cases() as $role)
                        <option class="capitalize" value="{{ $role->value }}">{{ $role->value }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                @error('name')
                    <div class="text-red-400 text-xs">{{ $message }}</div>
                @enderror
                <input type="password" name="password" class="border px-4 py-2" placeholder="Password">
            </div>
            <div>
                <button class="w-full bg-slate-600 text-white px-4 py-2">Register</button>
            </div>
        </form>
    </div>
</x-authentication>