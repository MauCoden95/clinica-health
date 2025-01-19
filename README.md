# Sistema de Reservas de Turnos Médicos

![Vista principal](https://i.ibb.co/YcHZrfD/imagen-2025-01-16-183125318.png)


## Descripción
Este proyecto es una aplicación web que permite a los pacientes reservar turnos médicos en línea con facilidad. Los médicos pueden administrar su disponibilidad y los pacientes recibirán notificaciones por correo electrónico.

## ===== Frontend ======
- Interfaz de usuario fácil de usar.
- Soporte para múltiples médicos y horarios.
- Mensajes de éxito, error o advertencia al interactuar con formularios u otros elementos.
- Una forma gráfica para seleccionar fechas y ver disponibilidad de turnos.
- Incorporación de íconos relevantes (por ejemplo, reloj, calendario, médico) para complementar textos.
- Ventanas emergentes para confirmar reservas, cancelar turnos o mostrar detalles adicionales.
- Representaciones visuales en dashboards para pacientes y administradores (por ejemplo, número de turnos reservados).

## ===== Admin =====
- Crear, editar, eliminar y listar médicos, incluyendo detalles como especialidad, licencia profesional, horarios disponibles y perfil.
- Registro, edición y desactivación de pacientes, con la posibilidad de consultar su historial médico o de reserva.
- Crear y organizar especialidades para facilitar la asignación de médicos.
- Visualizar y administrar las reservas de turnos, reasignar médicos, cancelar citas y gestionar turnos pendientes o no asignados.
- Crear y administrar usuarios del sistema con roles específicos (administrador, doctor, etc.).
- Gestionar los suministros y equipos médicos de la clínica. 

## ===== Tecnologías =====
- Laravel 11
- Alpine.js
- MySQL
- Tailwind CSS
- Livewire

## ===== Instalación =====
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


## ===== Capturas de pantalla =====
![Vista todos los pacientes](https://i.ibb.co/jVPbtVD/qqqqq.png)

![Vista de registro exitosa](https://i.ibb.co/3FMxGvC/qqqqq1.png)

![Vista turnos programados del paciente](https://i.ibb.co/KrfzFY8/qqqqq2.png)

![Vista reprogramar turno](https://i.ibb.co/jVPbtVD/qqqqq3.png)
