<?php

namespace App\Http\Controllers;


use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $task = new Task();
        $task->fill([
            'title' => $request->json('title'),
            'description' => $request->json('description'),
            'deadline' => $request->json('deadline'),
            'comment' => $request->json('comment'),
            'status' => $request->json('status'),
        ]);

        $task->save();

        return response()->json($task);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $task = Task::query()->where(['id' => $id])->first();

        $task->fill([
            'title' => $request->json('title', $task->title),
            'description' => $request->json('description', $task->description),
            'deadline' => $request->json('deadline', $task->deadline),
            'comment' => $request->json('comment', $task->comment),
        ]);

        $task->save();

        return response()->json($task);
    }

    public function read(Request $request, int $id): JsonResponse
    {
        $task = Task::query()->where(['id' => $id])->first();

        return response()->json($task);
    }

    public function readAll(Request $request): JsonResponse
    {
        $query = Task::query();
        $deadline = $request->get('deadline');
        $status = $request->get('status');

        if(null !== $deadline){
            $query = $query->where(['deadline' => $deadline]);
        }

        if(null !== $status){
            $query = $query->where(['status' => $status]);
        }

        $task = $query->get();

        return response()->json($task);
    }

    public function delete(Request $request, int $id): JsonResponse
    {
        $task = Task::query()->where(['id' => $id])->first();

        $task->delete();

        return response()->json([]);
    }
}
