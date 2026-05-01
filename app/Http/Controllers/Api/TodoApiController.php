<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Services\TodoService;

class TodoApiController extends Controller
{
    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index()
    {
        $todos = Todo::latest()->get();

        return response()->json($todos);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $todo = $this->todoService->create($request->all());

        return response()->json($todo, 201);
    }
}