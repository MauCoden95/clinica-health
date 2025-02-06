<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body class="w-full h-full bg-white mb-20">
    <h1 class="text-center text-2xl text-black my-12 py-10">Recuperar contraseña</h1>
    <img class="w-44 m-auto" src="{{ asset('img/Logo.png') }}" alt="Logo" />
    <form class="w-4/6 m-auto">
        <div class="mb-4">
            <input type="password" id="password" name="password" class="mt-1 bg-white block w-full px-3 py-2 border-b border-red-500  shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Contraseña">
        </div>
        <div class="mb-4">
            <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 bg-white block w-full px-3 py-2 border-b border-red-500  shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="Confirmar contraseña">
        </div>
        <div class="flex justify-center">
            <button type="submit" class="px-4 py-2 my-12 bg-red-500 hover:bg-red-800 duration-300 text-white w-full p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Enviar</button>
        </div>
    </form>
</body>
</html>