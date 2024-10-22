<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB as FacadesDB;

class FailoverDatabase
{
    public function handle($request, Closure $next)
    {
        try {
            // Intentar conectar a la base de datos principal
            FacadesDB::connection()->getPdo();
        } catch (\Exception $e) {
            // Si falla, cambiar a la base de datos de respaldo
            Config::set('database.default', 'mysql_backup');
        }

        return $next($request);
    }
}
