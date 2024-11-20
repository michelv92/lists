<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tarefa;

class TarefaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tarefa::create([
            'titulo' => 'Estudar PHP',
            'descricao' => 'Estudar estrutura de dados ... ',
            'status' => 'pendente',
            'data_conclusao' => null
        ]);

        Tarefa::create([
            'titulo' => 'Comprar SSD',
            'descricao' => 'Links de sites abaixo',
            'status' => 'pendente',
            'data_conclusao' => null
        ]);
    }
}
