<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuitemController extends Controller
{
    public function index()
    {
        // with = Eager Loading لتحسين الأداء
        $menuItems = Menuitem::with('menuCategory')->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.Menu_item.index', compact('menuItems'));
    }

    public function create()
    {
        // جلب الـ Categories لعرضها في الـ Dropdown
        $menuCategories = MenuCategory::all();
        return response()->view('cms.Menu_item.create', compact('menuCategories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Item_Name' => 'required|string|min:2',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric|min:0',
            'Status' => 'required|in:available,unavailable',
            'Spicy_Level' => 'nullable|string',
            'Menu_Categories_ID' => 'required|exists:menu_categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $menuItem = new MenuItem();
            $menuItem->Item_Name = $request->get('Item_Name');
            $menuItem->Description = $request->get('Description');
            $menuItem->Price = $request->get('Price');
            $menuItem->Status = $request->get('Status');
            $menuItem->Spicy_Level = $request->get('Spicy_Level');
            $menuItem->Menu_Categories_ID = $request->get('Menu_Categories_ID');
            $menuItem->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'Menu item added successfully!'
            ], 200);
        }
    }

    public function show($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        return response()->view('cms.Menu_item.show', compact('menuItem'));
    }

    public function edit($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuCategories = MenuCategory::all();
        return response()->view('cms.Menu_item.edit', compact('menuItem', 'menuCategories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Item_Name' => 'required|string|min:2',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric|min:0',
            'Status' => 'required|in:available,unavailable',
            'Spicy_Level' => 'nullable|string',
            'Menu_Categories_ID' => 'required|exists:menu_categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $menuItem = MenuItem::findOrFail($id);
            $menuItem->Item_Name = $request->get('Item_Name');
            $menuItem->Description = $request->get('Description');
            $menuItem->Price = $request->get('Price');
            $menuItem->Status = $request->get('Status');
            $menuItem->Spicy_Level = $request->get('Spicy_Level');
            $menuItem->Menu_Categories_ID = $request->get('Menu_Categories_ID');
            $menuItem->save();

            return ['redirect' => route('menu-items.index')];
        }
    }

    public function destroy($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->delete();
    }
}