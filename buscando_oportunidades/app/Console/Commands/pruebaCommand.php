<?php

namespace App\Console\Commands;

use App\Models\Emprendedor;
use App\Models\User;
use Illuminate\Console\Command;

class pruebaCommand extends Command
{
    protected $signature = 'prueba';

    protected $description = 'Command description';

    public function handle(): void
    {
        $users = User::factory(5)->create();

        $probandoRelaciones = $users->map(function ($user){
            return $user->subUsuarios();
        });

        $emprendedores = Emprendedor::factory(2)->create();

        $relacioEmprendedoresUsers = $emprendedores->map(function ($emp){
            return $emp->user();
        });

        dd($probandoRelaciones);
    }
}
