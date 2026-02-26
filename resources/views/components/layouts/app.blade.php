<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Scheduler App</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full text-sm">
    <div class="flex h-screen">
        <x-sidebar />
        <div class="flex flex-1 flex-col overflow-hidden">
            <x-topbar :title="$title" />
            <div class="h-full overflow-y-auto">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
