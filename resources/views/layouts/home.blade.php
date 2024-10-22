<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false, open: false }" x-init="darkMode = localStorage.getItem('darkMode') === 'true'">

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
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-lg w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-white" />
                    </a>
                </div>

                <!-- Links -->
                <div class="hidden md:flex space-x-6">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent leading-4 text-gray-800 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-3 rounded-md text-lg font-medium focus:outline-none transition ease-in-out duration-150">
                                <div>Productos</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Enlace para mostrar productos -->
                            <x-dropdown-link :href="route('products.index')">
                                {{ __('Mostrar productos') }}
                            </x-dropdown-link>

                            <!-- Enlace para crear productos -->
                            <x-dropdown-link :href="route('products.create')">
                                {{ __('Crear producto') }}
                            </x-dropdown-link>

                            <!-- Enlace para editar producto -->
                            <x-dropdown-link :href="route('products.select')">
                                {{ __('Editar producto') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <a href="{{ route('products.favorites') }}" class="text-gray-800 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-lg font-medium">
                        Favoritos
                    </a>
                    <a href="#" class="text-gray-800 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-lg font-medium">
                        Compras
                    </a>
                </div>

                <!-- Right side: Settings Dropdown and Dark Mode Toggle -->
                <div class="flex items-center space-x-4">
                    <!-- Cambiar Tema -->
                    <div class="ml-4">
                        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" class="bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-white p-2 rounded-full">
                            <template x-if="darkMode">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-8.66h-1m-15.32 0h-1m12.02-7.02l-.707-.707m-10.606 0l-.707.707m15.32 10.606l.707.707m-10.606 0l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z" />
                                </svg>
                            </template>
                            <template x-if="!darkMode">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-8.66h-1m-15.32 0h-1m12.02-7.02l-.707-.707m-10.606 0l-.707.707m15.32 10.606l.707.707m-10.606 0l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z" />
                                </svg>
                            </template>
                        </button>
                    </div>

                    <!-- Verificar si el usuario está autenticado -->
                    @if(Auth::check())
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endif
                </div>

                <!-- Hamburger menu for mobile -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-500 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none">
                        <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'block': !open }" class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path :class="{'block': open, 'hidden': !open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, toggle visibility with hamburger menu -->
        <div :class="{'block': open, 'hidden': !open}" class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('products.index') }}" class="block text-gray-800 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-2 rounded-md text-base font-medium">Productos</a>
                <a href="#" class="block text-gray-800 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-2 rounded-md text-base font-medium">Favoritos</a>
                <!-- Aquí podrías crear un dropdown en el menú móvil si lo necesitas -->
                <a href="#" class="block text-gray-800 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-2 rounded-md text-base font-medium">Compras</a>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content') <!-- Aquí se incluirá el contenido dinámico -->
        </div>
    </main>
</body>

</html>