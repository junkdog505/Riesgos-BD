<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar los campos
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'age' => ['required', 'integer', 'min:1'],
            'dni' => ['required', 'string', 'max:20'],
            'credit_card' => ['required', 'string', 'max:20'],
            'profile_image' => ['nullable', 'image', 'max:2048'], // Validar la imagen de perfil
        ]);

        // Manejar la imagen de perfil si existe
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        } else {
            $profileImagePath = null;
        }

        // Crear el usuario con los campos adicionales
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age, // Edad
            'dni' => $request->dni, // DNI
            'credit_card' => $request->credit_card, // Tarjeta de crédito
            'profile_image' => $profileImagePath, // Imagen de perfil
            'money_spent' => 0, // Inicializar en 0 el dinero gastado
        ]);

        // Disparar el evento de registro
        event(new Registered($user));

        // Iniciar sesión automáticamente
        Auth::login($user);

        // Redirigir al home después del registro
        return redirect(RouteServiceProvider::HOME);
    }
}
