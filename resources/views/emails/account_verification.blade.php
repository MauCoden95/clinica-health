<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="w-screen h-auto bg-white">
    <div class="w-3/6 m-auto bg-white">
        <img class="w-44 m-auto" src="{{ asset('img/Logo.png') }}" alt="Logo" />
        <h1 class="text-center text-red-600 text-3xl my-12">Hola {{ $user->name }}</h1>
        <p class="text-center my-6 text-black">Gracias por registrarte en nuestro sitio. Por favor, haz clic en el siguiente enlace para confirmar tu cuenta:</p>
        <a class="block m-auto text-center text-black duration-300 bg-red-500 hover:bg-red-400 p-3 rounded-md" href="{{ $verificationUrl }}">Confirmar cuenta</a>
    </div>
    
</body>
</html>