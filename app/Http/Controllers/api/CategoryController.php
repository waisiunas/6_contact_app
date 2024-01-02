<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'categories' => Category::where('user_id', '=', Auth::id())->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
            ]);
        } else {
            $data = [
                'name' => $request->name,
                'user_id' => Auth::id(),
            ];

            if (Category::create($data)) {
                return response()->json([
                    'success' => 'Magic has been spelled!',
                ]);
            } else {
                return response()->json([
                    'failure' => 'Magic has failed to spell!'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'category' => Category::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
            ]);
        } else {
            $data = [
                'name' => $request->name,
            ];

            $category = Category::find($id);

            if ($category->update($data)) {
                return response()->json([
                    'success' => 'Magic has been spelled!',
                ]);
            } else {
                return response()->json([
                    'failure' => 'Magic has failed to spell!'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if ($category->delete()) {
            return response()->json([
                'success' => 'Magic has been spelled!',
            ]);
        } else {
            return response()->json([
                'failure' => 'Magic has failed to spell!'
            ]);
        }
    }
}
