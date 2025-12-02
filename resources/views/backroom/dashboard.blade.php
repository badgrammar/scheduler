<x-layout title="Dashboard">
    <div class="mb-3 flex items-center space-x-3">
        <span class="material-symbols-rounded" style="font-size: 14px;">calendar_today</span>
        <span>@tanggal(\Carbon\Carbon::now())</span>
    </div>
    <x-tasks-table/>
</x-layout>