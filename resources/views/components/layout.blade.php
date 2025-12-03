<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduler App</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>
<body class="flex h-screen text-sm">
    <x-sidebar/>
    <main class="overflow-y-auto w-full">
        <x-topbar :title="$title"/>
        {{ $slot }}
    </main>
</body>
</html>