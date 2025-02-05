<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="w-screen h-screen bg-white">
    <div class="w-3/6 m-auto">
        <img class="w-44 m-auto" src="{{ asset('img/Logo.png') }}" alt="Logo" />
        <h1 class="text-center text-red-600 text-3xl my-12">Su cuenta ha sido verificada</h1>
        <a class="block w-full text-center text-2xl text-red-500" href="http://localhost:8000/login">Ir a la pagina de login</a>
    </div>
    
</body>
</html>