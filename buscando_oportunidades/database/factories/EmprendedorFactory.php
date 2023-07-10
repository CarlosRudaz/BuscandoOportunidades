<?php

namespace Database\Factories;

use App\Enums\TipoActividad;
use App\Models\Emprendedor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EmprendedorFactory extends Factory
{
    protected $model = Emprendedor::class;

    public function definition(): array
    {
        $array = [1, 2, 3];
        return [
            'direccion' => $this->faker->address(),
            'celulares' => $array,
            'actividad' => TipoActividad::in_randomOrder()[0],
            'user_id' => User::inRandomOrder()->first()->id,
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-50 years'),
        ];
    }
}
