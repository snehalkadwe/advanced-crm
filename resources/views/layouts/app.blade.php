<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>@yield('title')</title>
    </head>

    <body class="bg-gray-100 text-gray-800">
        <nav class="bg-blue-600 text-white py-4">
            <div class="container mx-auto">
                <a href="/" class="text-lg font-bold">CRM</a>
            </div>
        </nav>
        <div class="container mx-auto py-6">
            @yield('content')
        </div>
    </body>

</html>
