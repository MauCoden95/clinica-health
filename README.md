# Sistema de Reservas de Turnos Médicos

![Vista princiapal](https://i.ibb.co/YcHZrfD/imagen-2025-01-16-183125318.png)


## Descripción
Este proyecto es una aplicación web que permite a los pacientes reservar turnos médicos en línea con facilidad. Los médicos pueden administrar su disponibilidad y los pacientes recibirán notificaciones por correo electrónico.

## Características
- Interfaz de usuario fácil de usar.
- Soporte para múltiples médicos y horarios.
- Notificaciones automáticas por correo electrónico.
- Sistema de autenticación seguro con contraseña hasheada.
- Sistema de roles y permisos

## Tecnologías
- Laravel 11
- Alpine.js
- MySQL
- Tailwind CSS
- Livewire

## Instalación
1. Clona el repositorio:
   ```bash
   git clone https://github.com/usuario/clinica-health.git

2. Navega al directorio del proyecto:
   cd clinica-health

3. Instala las dependencias:
   composer install
   npm install

4. Configura el archivo .env:
   cp .env.example .env

5. Genera la clave de la aplicación:
    php artisan key:generate

6. Corre las migraciones:
    php artisan migrate

7. Inicia el servidor de desarrollo:
   php artisan serve
    Accede a la aplicación en http://localhost:8000.
