<x-authentication>
    <div class="p-4 space-y-4">
        <div>Login</div>
        <form action="{{route('auth.login')}}" class="space-y-4" method="POST">
            @csrf
            <div>
                <input type="text" name="email" class="border px-4 py-2" placeholder="Email">
            </div>
            <div>
                <input type="password" name="password" class="border px-4 py-2" placeholder="Password">
            </div>
            <div>
                <button class="w-full bg-slate-600 text-white px-4 py-2">Login</button>
            </div>
        </form>
    </div>
</x-authentication>