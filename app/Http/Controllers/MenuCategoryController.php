<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $menuCategories = MenuCategory::orderBy('id', 'desc')->paginate(10);
    return response()->view('cms.menu_category.index', compact('menuCategories'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return response()->view('cms.menu_category.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuCategory $menuCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $menuCategory = MenuCategory::findOrFail($id);
    return response()->view('cms.menu_category.edit', compact('menuCategory'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuCategory $menuCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuCategory $menuCategory)
    {
        //
    }
}
