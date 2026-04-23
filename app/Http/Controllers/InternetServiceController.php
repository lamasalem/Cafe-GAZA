<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\InternetService;
use Illuminate\Http\Request;

class InternetServiceController extends Controller
{
    public function index()
    {
        $internetServices = InternetService::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.internet_service.index', compact('internetServices'));
    }

    public function create()
    {
        return response()->view('cms.internet_service.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required|string|max:100|unique:internet_services,service_name',
            'speed' => 'required|string',
            'price' => 'required|numeric'
        ], [

            'service_name.required' => 'حقل اسم الخدمة مطلوب.',
            'speed.required' => 'حقل السرعة مطلوب.',
            'price.required' => 'حقل السعر مطلوب.',
            'price.numeric' => 'يجب أن يكون السعر قيمة رقمية.'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);

        } else {

            $internetService = new InternetService();
            $internetService->service_name = $request->get('service_name');
            $internetService->speed = $request->get('speed');
            $internetService->price = $request->get('price');
            $internetService->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'تم إضافة خدمة الإنترنت بنجاح'
            ], 200);
        }
    }

    public function show(InternetService $internetService)
    {
        //
    }

    public function edit($id)
    {
        $internetService = InternetService::findOrFail($id);
        return response()->view('cms.internet_service.edit', compact('internetService'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'service_name' => 'required|string|max:100|unique:internet_services,service_name,' . $id,
            'speed' => 'required|string',
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);

        } else {
            $internetService = InternetService::findOrFail($id);
            $internetService->service_name = $request->get('service_name');
            $internetService->speed = $request->get('speed');
            $internetService->price = $request->get('price');
            $internetService->save();

            return ['redirect' => route('internet-services.index')];

        }
    }

    public function destroy($id)
    {
        $internetService = InternetService::findOrFail($id);
        $internetService->delete();
    }
}
