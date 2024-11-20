<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tarefa;

class TarefaController extends Controller
{
    public function index ()
    {
        return response()->json(Tarefa::all());
    }

    public function create()
    {
        return inertia('NovaTarefaComponente');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'required|integer|in:1,2,3',
        ]);

        $validate['user_id'] = Auth::id();

        Tarefa::create($validate);
        
        return redirect()->route('dashboard')->with('success', 'Tarefa criada com sucesso!');
    }

    public function edit($id)
    {
        $tarefa = Tarefa::findOrFail($id);

        return inertia('TarefaEdit', [
            'tarefa' => $tarefa
        ]);
    }

    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::findOrFail($id);

        $tarefa->update($request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'status' => 'required|integer',
        ]));

        return redirect()->route('dashboard');
    }
}
