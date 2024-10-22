@extends('layouts.home')

@section('content')
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200">Bienvenido a Mi Aplicación</h1>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Explora nuestras funciones y conoce más sobre nosotros.</p>
        <div class="mt-6">
            <a href="{{ route('register') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500">Registrarse</a>
            <a href="{{ route('login') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 ml-4">Iniciar Sesión</a>
        </div>
    </div>
@endsection
