<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $table = 'tarefas';

    protected $fillable = [
        'titulo',
        'descricao',
        'status',
        'data_conclusao',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
