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
}

