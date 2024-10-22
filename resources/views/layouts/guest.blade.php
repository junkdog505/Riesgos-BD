<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }" x-init="darkMode = localStorage.getItem('darkMode') === 'true'">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body :class="{ 'dark': darkMode }" class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            
            <!-- Botón para cambiar entre tema claro y oscuro con iconos -->
            <div class="absolute top-4 right-4">
                <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" class="bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-white p-2 rounded-full">
                    <template x-if="darkMode">
                        <!-- Icono de sol para modo claro -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-8.66h-1m-15.32 0h-1m12.02-7.02l-.707-.707m-10.606 0l-.707.707m15.32 10.606l.707.707m-10.606 0l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z" />
                        </svg>
                    </template>
                    <template x-if="!darkMode">
                        <!-- Icono de luna para modo oscuro -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-8.66h-1m-15.32 0h-1m12.02-7.02l-.707-.707m-10.606 0l-.707.707m15.32 10.606l.707.707m-10.606 0l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z" />
                        </svg>
                    </template>
                </button>
            </div>

            <!-- Logo -->
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <!-- Contenedor principal -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
