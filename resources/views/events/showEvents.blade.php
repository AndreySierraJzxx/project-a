@if(session('success'))
<script>
  alert("{{ session('success') }}");
</script>
@endif

@if(session('error'))
<script>
  alert("{{ session('error') }}");
</script>
@endif

@extends('layouts.app')

@section('content')

<div class="min-h-full">
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="shrink-0">
            <img class="size-8" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
          </div>
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Gestiona los eventos y participantes</h1>
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <a href="{{ route('home') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" aria-current="page">Inicio</a>
              <a href="{{ route('events.showEvents') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white">Eventos</a>
              <a href="{{ route('participants.showParticipants') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Participantes</a>

            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-2xl font-bold mb-4">Gestion de Eventos</h1>
      <div class="text-black">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3 rounded-s-lg">Registro</th>
              <th scope="col" class="px-6 py-3 rounded-s-lg">Nombre</th>
              <th scope="col" class="px-6 py-3 rounded-s-lg">Fecha</th>
              <th scope="col" class="px-6 py-3 rounded-s-lg">Capacidad</th>
              <th scope="col" class="px-6 py-3 rounded-s-lg">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($events as $event)
            <tr>
              <td class="px-6 py-1">{{ $event->id }}</td>
              <td class="px-6 py-4">{{ $event->name }}</td>
              <td class="px-6 py-4">{{ $event->date }}</td>
              <td class="px-6 py-4">{{ $event->capacity }}</td>
              <td class="px-6 py-4">
                <a href="{{ route('events.show', $event->id) }}" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Ver</a>
                <a href="{{ route('events.edit', $event->id) }}" class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">Editar</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" onclick="return confirm('¿Estás seguro de eliminar este evento?')">Eliminar</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div><br><br>
      <a href="{{ route('events.create') }}" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Crear Evento</a>
      <a href="{{ route('home') }}" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Volver al inicio</a>
    </div>
  </main>
</div>
@endsection