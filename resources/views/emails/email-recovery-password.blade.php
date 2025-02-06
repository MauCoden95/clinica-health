<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body class="w-full h-full bg-white py-28 mb-20">
    <h1 class="text-center text-2xl text-black my-12 py-10">Recuperar contraseña</h1>
    <img class="w-44 m-auto" src="{{ asset('img/Logo.png') }}" alt="Logo" />
    <h2 class="text-center my-10">Con este enlace, podrás cambiar tu contraseña, el mismo caducará dentro de una hora</h2>
    <a class="block w-full m-auto text-center text-red-500 hover:text-red-700 my-11" href="{{ $resetUrl }}">Cambiar contraseña</a>
</body>
</html>