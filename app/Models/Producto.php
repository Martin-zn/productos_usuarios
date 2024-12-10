<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'precio', 
        'descripcion',
        'imagen',
        'path',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($producto) {
            if (!$producto->path) {
                $producto->path = 'producto-' . (Producto::max('id') + 1);
            }
        });
    }
    
}
