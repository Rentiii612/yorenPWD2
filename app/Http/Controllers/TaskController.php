<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('welcome', compact('tasks'));
    }

    public function store(Request $request)
    {
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect('/')->with('success', 'Task berhasil ditambahkan');
    }

    public function complete(Task $task)
    {
        $task->update([
            'completed' => true,
            'completed_at' => now()
        ]);

        return redirect('/');
    }

    public function update(Request $request, Task $task)
    {
        if ($task->completed) {
            return redirect('/')->with('error', 'Task sudah selesai');
        }

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect('/')->with('success', 'Task berhasil diupdate');
    }

    public function destroy(Task $task)
    {
        if ($task->completed) {
            return redirect('/')->with('error', 'Task sudah selesai tidak bisa dihapus');
        }

        $task->delete();

        return redirect('/')->with('success', 'Task berhasil dihapus');
    }

    public function report()
    {
        $data = Task::selectRaw('due_date, COUNT(*) as total')
            ->where('completed', false)
            ->groupBy('due_date')
            ->orderBy('due_date')
            ->get();

        return view('report', compact('data'));
    }
}