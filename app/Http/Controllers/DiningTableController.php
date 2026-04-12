<?php

namespace App\Http\Controllers;

use App\Models\DiningTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    // 1. التحقق من صحة البيانات (Validation)
    $validator = Validator::make($request->all(), [
        'table_number' => 'required|integer|min:1|unique:dining_tables,table_number', 
        'capacity' => 'required|integer|min:1',
        'status' => 'required|in:available,occupied,reserved'
    ], [
        'table_number.required' => 'حقل رقم الطاولة مطلوب.',
        'table_number.unique' => 'رقم الطاولة مسجل مسبقاً.',
        'capacity.required' => 'حقل سعة الطاولة مطلوب.',
        'status.in' => 'الرجاء اختيار حالة صحيحة.'
    ]);

    // 2. هل فشلت عملية التحقق؟
    if ($validator->fails()) {
        // إذا فشلت: طلع رسالة الفشل
        return response()->json([
            'icon' => 'error',
            'title' => $validator->getMessageBag()->first() 
        ], 400); 

    } else {
        // الس (else) إذا ما فشلت: خزن البيانات
        $diningTable = new DiningTable();
        $diningTable->table_number = $request->get('table_number');
        $diningTable->capacity = $request->get('capacity');
        $diningTable->status = $request->get('status');
        $diningTable->save(); 

        return response()->json([
            'icon' => 'success',
            'title' => 'تم إضافة الطاولة بنجاح!'
        ], 200); 
    }
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
       public function update(Request $request, $id)
{
    // 1. التحقق من صحة البيانات
    $validator = Validator::make($request->all(), [
        // استثنينا رقم الطاولة الحالي من شرط الـ unique عشان ما يعطي خطأ لو ما غيرنا الرقم
        'table_number' => 'required|integer|min:1|unique:dining_tables,table_number,' . $id, 
        'capacity' => 'required|integer|min:1',
        'status' => 'required|in:available,occupied,reserved'
    ]);

    // 2. هل فشلت عملية التحقق؟
    if ($validator->fails()) {
        return response()->json([
            'icon' => 'error',
            'title' => $validator->getMessageBag()->first() 
        ], 400); 

    } else {
        // 3. التعديل باستخدام findOrFail حسب شرح الدكتور
        $diningTable = DiningTable::findOrFail($id);
        $diningTable->table_number = $request->get('table_number');
        $diningTable->capacity = $request->get('capacity');
        $diningTable->status = $request->get('status');
        $diningTable->save(); 

        // 4. إرجاع رسالة النجاح (حسب سكريبت الدكتور، ممكن يوجهك لصفحة الاندكس تلقائياً)
        return ['redirect' => route('dining-tables.index')];

}}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
