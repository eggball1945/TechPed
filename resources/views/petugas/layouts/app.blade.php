<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 m-0 p-0 overflow-hidden">

    <div class="flex w-screen h-screen">

        <aside class="w-[245px] h-screen bg-white border-r border-gray-300/70 flex flex-col justify-between">
            @include('petugas.layouts.sidebar')
        </aside>

        <div class="flex flex-col flex-1 h-screen">

            <header class="font-[Poppins] h-14 flex items-center justify-between px-4 bg-white border-b border-gray-300/70 shrink-0">
                @include('petugas.layouts.header')
            </header>

            <main class="font-[poppins] flex-1 overflow-y-auto bg-gray-100">
                @yield('content')
            </main>

        </div>

    </div>
    
</body>
</html> 