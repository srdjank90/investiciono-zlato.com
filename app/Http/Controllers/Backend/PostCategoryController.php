<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCategoryController extends BackendController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Items per page
        $perPage = 6;
        $postCategories = PostCategory::paginate($perPage);
        return view('backend.posts.categories.index', compact(['postCategories']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $postCategory = new PostCategory($request->all());
        $postCategory->created_by = Auth::user()->id;
        $postCategory->save();
        return redirect()->route('backend.posts.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $postCategory = PostCategory::find($id);
        $postCategory->delete();
        return response()->json(['type' => 'success', 'message' => 'Deleted!'], 200);
    }
}
