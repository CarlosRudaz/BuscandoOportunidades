<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Emprendedor */
class EmprendedorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'celular' => $this->celular,
            'actividad' => $this->actividad,
            'user_id' => $this->user_id,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'billetera_id' => $this->billetera_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
