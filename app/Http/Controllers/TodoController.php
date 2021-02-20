<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoApiRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoController extends Controller {

    public function index() {
        return TodoResource::collection(auth()->user()->todos()->latest()->get());
    }

    public function store(TodoApiRequest $request) {
        $todo = auth()->user()->todos()
            ->create($request->validated());

        return new TodoResource($todo);
    }

    public function update(TodoApiRequest $request, Todo $todo) {
        $todo->update($request->validated());

        return new TodoResource($todo);
    }

    public function destroy(Todo $todo) {
        $todo->delete();
        return 'ok';
    }
}
