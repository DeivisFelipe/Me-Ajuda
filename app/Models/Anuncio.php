<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'imagem',
        'telefone',
        'whatsapp',
        'email',
        'cidade',
        'tipo',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTipoAttribute($value)
    {
        return $value ? 'Precisar' : 'Ajudar';
    }
}
