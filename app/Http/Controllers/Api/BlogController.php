<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use Exception;

class BlogController extends Controller
{
    public function store(StoreBlogRequest $request)
    {

        $validated = $request->validated();
        try {
            $blog = Blog::create([
                'resource_id' => $validated['resource_id'],
                'identifier' => $validated['identifier'],
                'cat_name' => $validated['cat_name'],
                'check_interval' => $validated['check_interval'],
                'last_sync_at' => null,
            ]);

            return response()->json($blog, 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Произошла внутренняя ошибка сервера.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
