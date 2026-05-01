<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\TodoService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TodoController extends Controller
{
    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }
    
    public function index()
    {
        $todos = Todo::with('category')
            ->latest()
            ->get();

        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('todos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'attachment' => 'nullable|file|max:2048',
        ]);

        $this->todoService->create($request->all(),$request->file('attachment'));

        return redirect()->route('todos.index');
    }

    public function edit(Todo $todo)
    {
        $categories = Category::orderBy('name')->get();
        return view('todos.edit', compact('todo', 'categories'));
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'nullable',
            'is_done' => 'nullable|boolean',
        ]);

        $todo->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'is_done' => $request->boolean('is_done'),
        ]);

        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $sort = $request->sort ?? 'desc';

        $todos = Todo::query()
            ->where('is_done', 0)
            ->orderby('created_at', $sort)
            ->when($keyword, function ($query, $keyword) {
                $query->where('title', 'like', "%{$keyword}%");
            })
            ->get();

        return view('todos.search', compact('todos', 'keyword', 'sort'));
    }
}
