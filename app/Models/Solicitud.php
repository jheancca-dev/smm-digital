<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'user_id',
        'monto_solicitado',
        'plazo_meses',
        'ingreso_mensual',
        'egresos_mensuales',
        'carga_familiar',
        'antiguedad_laboral',
        'dni_archivos',
        'boleta_archivos',
        'ratio_deuda_ingreso',
        'calificacion',
        'estado',
    ];

    protected $casts = [
        'dni_archivos' => 'array',
        'boleta_archivos' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}