<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuCategoryController extends Controller
{
    public function index()
    {
        $menuCategories = MenuCategory::withCount('menuItems')->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.menu_category.index', compact('menuCategories'));
    }

    public function create()
    {
        return response()->view('cms.menu_category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|unique:menu_categories,name',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $menuCategory = new MenuCategory();
            $menuCategory->name = $request->get('name');
            $menuCategory->status = $request->get('status');
            $menuCategory->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'تم إضافة الصنف بنجاح'
            ], 200);
        }
    }

    public function show(MenuCategory $menuCategory)
    {
        $menuCategory->load('menuItems');

        return response()->view('cms.menu_category.show', compact('menuCategory'));
    }

    public function edit($id)
    {
        $menuCategory = MenuCategory::findOrFail($id);
        return response()->view('cms.menu_category.edit', compact('menuCategory'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|unique:menu_categories,name,' . $id,
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $menuCategory = MenuCategory::findOrFail($id);
            $menuCategory->name = $request->get('name');
            $menuCategory->status = $request->get('status');
            $menuCategory->save();

            return ['redirect' => route('menu-categories.index')];
        }
    }

    public function destroy($id)
    {
        $menuCategory = MenuCategory::findOrFail($id);
        $menuCategory->delete();
    }

}
