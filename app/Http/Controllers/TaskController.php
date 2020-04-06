<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskController extends Controller
{
    public function index()
    {
        try {
            return response()->json(Task::orderBy('created_at', 'desc')->get());
        } catch (ModelNotFoundException $exception) {
            return response()->json('Nothing to get');
        }
    }

    public function store(TaskRequest $request)
    {
        try {
            return Task::create($request->all());
        } catch (ModelNotFoundException $exception) {
            return response()->json('Creation error');
        }
    }

    public function update(TaskRequest $request, $id)
    {
        try {
            return Task::findOrFail($id)->update($request->all());
        } catch (ModelNotFoundException $exception) {
            return response()->json('Update error');
        }
    }

    public function show($id)
    {
        try {
            return Task::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json('Nothing to get for this id');
        }
    }

    public function destroy($id)
    {
        try {
            return Task::findOrFail($id)->delete();
        } catch (ModelNotFoundException $exception) {
            return response()->json('Nothing to delete for this id');
        }
    }
}
