<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Inscripción</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md max-w-md text-center">
        <h2 class="text-2xl font-bold text-gray-800">¡Hola, {{ $participant->name }}!</h2>
        <p class="mt-4 text-gray-600">Te has inscrito exitosamente al evento <strong class="text-indigo-600">{{ $event->name }}</strong>.</p>
        <p class="mt-2 text-gray-600">Fecha del evento: <span class="font-semibold">{{ $event->date }}</span></p>
        <p class="mt-4 text-gray-600">Gracias por participar te esperamos.</p>
        <p class="mt-6 text-gray-500">Saludos,</p>
        <p class="text-gray-700 font-semibold">Equipo de organización</p>
    </div>
</body>

</html>