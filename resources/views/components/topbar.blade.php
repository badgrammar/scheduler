<aside class="flex w-full top-0 sticky bg-white p-3 justify-between items-center border-b border-gray-200">
    <div class="font-bold">{{ $title }}</div>
    <div class=" flex space-x-6 items-center text-sm">
        <div>{{ $user->name }}</div>
        <a href="{{ route('auth.logout') }}" class="inline-flex items-center">
            <span class="material-symbols-rounded text-red-600 ">logout</span>
        </a>
    </div>
</aside>