<?php

namespace App\Http\Controllers;

use App\Models\DiningTable;
use Illuminate\Http\Request;

class DiningTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $diningTables = DiningTable::orderBy('id', 'desc')->paginate(10);
    return response()->view('cms.Dining_table.index', compact('diningTables'));
}

    /**
     * Show the form for creating a new resource.
     */
      public function create()
{
    return response()->view('cms.Dining_table.create');
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
    public function show($id)
{
    $diningTable = DiningTable::findOrFail($id);
    return response()->view('cms.Dining_table.show', compact('diningTable'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $diningTable = DiningTable::findOrFail($id);
    return response()->view('cms.Dining_table.edit', compact('diningTable'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DiningTable $diningTable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiningTable $diningTable)
    {
        //
    }
}
