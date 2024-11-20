<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tarefa;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 1) {
            $tarefa = Tarefa::all();
            // dd($tarefa);
        } else {
            $tarefa = Tarefa::where('user_id', $user->id)->get();
        }

        // foreach ($tarefa as $task) {
        //     $task->created_at = $task->created_at->format('d/m/Y H:i:s');
        // }

        return Inertia::render('Dashboard',[
            'tarefa' => $tarefa,
        ]);
    }

    // public function fetchTasks(Request $request)
    // {

    //     $userId = Auth::id();
        

    //     $query = Tarefa::query();
        
    //     if ($userId !== 2) {
    //         $query->where('user_id', $userId);
    //     }

    //     $search = $request->input('search')['value'] ?? '';
    //     $orderColumnIndex = $request->input('order')[0]['column'] ?? 0;
    //     $orderDir = $request->input('order')[0]['dir'] ?? 'asc';
    //     $start = $request->input('start') ?? 0;
    //     $length = $request->input('length') ?? 10;

    //     $columns = ['id', 'titulo', 'descricao', 'status'];

    //     if ($search) {
    //         $query->where('titulo', 'like', '%' . $search . '%')
    //             ->orWhere('descricao', 'like', '%' . $search . '%')
    //             ->orWhere('status', 'like', '%' . $search . '%');
    //     }

    //     $query->orderBy($columns[$orderColumnIndex], $orderDir);

    //     $tarefas = $query->offset($start)->limit($length)->get();

    //     $filteredCount = $query->count();

    //     $total = Tarefa::count();

    //     return response()->json([
    //         'draw' => $request->input('draw'),
    //         'recordsTotal' => $total,
    //         'recordsFiltered' => $filteredCount,
    //         'data' => $tarefas,
    //     ]);
    // }
}

