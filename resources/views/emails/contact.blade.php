<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo correo electrónico</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f3f4f6; padding: 20px; text-align: center; }
        .content { background-color: #ffffff; padding: 20px; }
        .footer { background-color: #f3f4f6; padding: 10px; text-align: center; font-size: 12px; }
    </style>
</head>
<body style="background-color: #f9fafb;">
    <div class="container">
        <div class="header">
            <h1 style="color: #1f2937; margin: 0;">Nuevo Mensaje de Contacto</h1>
        </div>
        <div class="content">
            <p style="margin-bottom: 10px;">
                <strong style="color: #4b5563;">Nombre:</strong> 
                <span style="color: #6b7280;">{{ $data['name'] }}</span>
            </p>
            <p style="margin-bottom: 10px;">
                <strong style="color: #4b5563;">Correo Electrónico:</strong> 
                <span style="color: #6b7280;">{{ $data['email'] }}</span>
            </p>
            <p style="margin-bottom: 5px;">
                <strong style="color: #4b5563;">Mensaje:</strong>
            </p>
            <p style="background-color: #f3f4f6; padding: 10px; border-radius: 4px; color: #6b7280;">
                {{ $data['message'] }}
            </p>
        </div>
        <div class="footer">
            <p style="margin: 0; color: #9ca3af;">© 2024 Tu Empresa. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>