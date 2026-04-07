<?php

namespace App\Http\Controllers;

use App\Models\InternetService;
use Illuminate\Http\Request;

class InternetServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $internetServices = InternetService::orderBy('id', 'desc')->paginate(10);
    return response()->view('cms.internet_service.index', compact('internetServices'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return response()->view('cms.internet_service.create');
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
    public function show(InternetService $internetService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
{
    $internetService = InternetService::findOrFail($id);
    return response()->view('cms.internet_service.edit', compact('internetService'));
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InternetService $internetService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternetService $internetService)
    {
        //
    }
}
