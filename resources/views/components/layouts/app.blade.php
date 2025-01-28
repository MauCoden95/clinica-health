<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    {{--FONT AWESOME--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.2/dist/cdn.min.js" defer></script>
 
    
    @livewireStyles
</head>
<body data-theme="light">
    {{ $slot }}
    


    <script>
        function data(){
            return {
                open: false,
                start(){
                    this.open = true
                },
                isOpen(){
                    this.open = !this.open
                },
                close(){
                    this.open = false
                }
            }
        }
    </script>
    @livewireScripts

    @stack('scripts')
</body>
</html>
