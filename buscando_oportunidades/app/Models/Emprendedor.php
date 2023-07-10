<?php

namespace App\Models;

use App\Enums\TipoActividad;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin \Eloquent
 * @property string $direccion
 * @property TipoActividad $atividad
 * @property int $user_id
 * @property Carbon $fecha_nacimiento
 * @property int $billetera_id
 */
class Emprendedor extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'emprendedores';
    protected $fillable = [
        'direccion',
        'actividad',
        'user_id',
        'fecha_nacimiento',
        'billetera_id',
    ];

    protected $casts = [
        'telefonos' => 'array',
        'celulares' => 'array',
        'actividad' => TipoActividad::class,
        'fecha_nacimiento' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
