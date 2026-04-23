<?php

namespace App\Http\Controllers;

use App\Models\DiningTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiningTableController extends Controller
{
    public function index()
    {
        $diningTables = DiningTable::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.Dining_table.index', compact('diningTables'));
    }

    public function create()
    {
        return response()->view('cms.Dining_table.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'table_number' => 'required|integer|min:1|unique:dining_tables,table_number',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,occupied,reserved'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $diningTable = new DiningTable();
            $diningTable->table_number = $request->get('table_number');
            $diningTable->capacity = $request->get('capacity');
            $diningTable->status = $request->get('status');
            $diningTable->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'تم إضافة الطاولة بنجاح'
            ], 200);
        }
    }

    public function show($id)
    {
        $diningTable = DiningTable::findOrFail($id);
        return response()->view('cms.Dining_table.show', compact('diningTable'));
    }

    public function edit($id)
    {
        $diningTable = DiningTable::findOrFail($id);
        return response()->view('cms.Dining_table.edit', compact('diningTable'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'table_number' => 'required|integer|min:1|unique:dining_tables,table_number,' . $id,
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,occupied,reserved'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $diningTable = DiningTable::findOrFail($id);
            $diningTable->table_number = $request->get('table_number');
            $diningTable->capacity = $request->get('capacity');
            $diningTable->status = $request->get('status');
            $diningTable->save();

            return ['redirect' => route('dining-tables.index')];
        }
    }

    public function destroy($id)
    {
        $diningTable = DiningTable::findOrFail($id);
        $diningTable->delete();
    }
}