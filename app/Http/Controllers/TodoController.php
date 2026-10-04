<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todo = Todo::where('user_id', Auth::id)->latest()->get();

        return view('todos.index', compact('todo'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        Todo::create($data);

        return redirect()->route('todos.index')->with('success', 'Todo berhasil ditambahkan.');
    }

    public function updateStatus(Request $request, Todo $todo)
    {
        abort_if($todo->user_id !== Auth::id(), 403);

        $request->validate(['status' => 'required|in:Todo,doing,done']);
        $todo->update(['status' => $request->status]);

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy(Todo $id)
    {
        $id->delete();

        return back()->with('success', 'Todo berhasil dihapus.');
    }
}
