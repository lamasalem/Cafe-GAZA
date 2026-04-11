<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
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
    // 1. التحقق من صحة البيانات (Validation)
    $validator = Validator::make($request->all(), [
        'service_name' => 'required|string|max:100|unique:internet_services,service_name', 
        'speed' => 'required|string',
        'price' => 'required|numeric'
    ], [
        // رسائل الخطأ المخصصة
        'service_name.required' => 'حقل اسم الخدمة مطلوب.',
        'speed.required' => 'حقل السرعة مطلوب.',
        'price.required' => 'حقل السعر مطلوب.',
        'price.numeric' => 'يجب أن يكون السعر قيمة رقمية.'
    ]);

    // 2. هل فشلت عملية التحقق؟
    if ($validator->fails()) {
        // إذا فشلت: طلع رسالة الفشل بالـ title
        return response()->json([
            'icon' => 'error',
            'title' => $validator->getMessageBag()->first() 
        ], 400); 

    } else {
        // الس (else) إذا ما فشلت: خزن البيانات
        $internetService = new InternetService();
        $internetService->service_name = $request->get('service_name');
        $internetService->speed = $request->get('speed');
        $internetService->price = $request->get('price');
        $internetService->save(); 

        // إرجاع رسالة النجاح
        return response()->json([
            'icon' => 'success',
            'title' => 'تم إضافة خدمة الإنترنت بنجاح!'
        ], 200); 
    }
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
    public function update(Request $request, $id)
{
    // 1. التحقق من صحة البيانات
    $validator = Validator::make($request->all(), [
        // استثنينا الخدمة الحالية من شرط عدم التكرار
        'service_name' => 'required|string|max:100|unique:internet_services,service_name,' . $id, 
        'speed' => 'required|string',
        'price' => 'required|numeric'
    ]);

    // 2. إذا فشل التحقق
    if ($validator->fails()) {
        return response()->json([
            'icon' => 'error',
            'title' => $validator->getMessageBag()->first() 
        ], 400); 

    } else {
        // 3. التعديل والحفظ
        $internetService = InternetService::findOrFail($id);
        $internetService->service_name = $request->get('service_name');
        $internetService->speed = $request->get('speed');
        $internetService->price = $request->get('price');
        $internetService->save(); 

        // 4. رسالة النجاح والتوجيه لصفحة العرض
        return ['redirect' => route('internet-services.index')];
            
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternetService $internetService)
    {
      
    }
}
