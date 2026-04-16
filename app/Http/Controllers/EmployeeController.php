<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
{
    // بنجيب الموظفين ومعاهم بيانات اليوزر المرتبط فيهم
    $employees = Employee::with('user')->get(); 
    
    return response()->view('cms.employee.index', compact('employees'));
}

    public function create()
    {
        return response()->view('cms.employee.create');
    }

    public function store(Request $request)
{

    $validator = Validator::make($request->all(), [
        'name'      => 'required|string|max:100',
        'Job_Title' => 'required|string|max:100',
        'email'     => 'required|email|unique:users,email',
        'phone'     => 'required|string|max:20',
        'password'  => 'required|string|min:6',
    
    ]);

    if ($validator->fails()) {
        return response()->json([
            'icon'  => 'error',
            'title' => $validator->getMessageBag()->first()
        ], 400);
    } 
    
    // 2. إذا كل شي تمام، بننشئ الموظف
    $employee = new Employee();
    $employee->Job_Title = $request->get('Job_Title');
    $isSaved = $employee->save();

    if ($isSaved) {
        // 3. إنشاء اليوزر المرتبط (الـ Morphs)
        $employee->user()->create([
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'phone'    => $request->get('phone'),
            'password' => Hash::make($request->get('password')),
                'role'     => 'employee',
        ]);

        return response()->json([
            'icon'  => 'success',
            'title' => 'تم إضافة الموظف بنجاح!'
        ], 200);
    }

    return response()->json([
        'icon'  => 'error',
        'title' => 'فشل في عملية الإضافة'
    ], 400);}

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->view('cms.employee.show', compact('employee'));
    }

  public function edit($id)
    {
        // بنجيب الموظف مع بيانات اليوزر تبعته عشان نعرضها في الفورم
        $employee = Employee::with('user')->findOrFail($id);
        return response()->view('cms.employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::with('user')->findOrFail($id);
        
        // بنجيب ID اليوزر عشان نستثنيه من فحص تكرار الإيميل
        $userId = $employee->user ? $employee->user->id : null;

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:100',
            'Job_Title' => 'required|string|max:100',
            // هون السحر: افحص الإيميل في جدول users، بس استثني صاحب هاد الـ ID
            'email'     => 'required|email|unique:users,email,' . $userId,
            'phone'     => 'required|string|max:20',
            'password'  => 'nullable|string|min:6', // صار nullable (اختياري)
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon'  => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        }

        // 1. تحديث بيانات الموظف
        $employee->Job_Title = $request->get('Job_Title');
        $isSaved = $employee->save();

        if ($isSaved) {
            // 2. تجهيز بيانات اليوزر للتحديث
            $userData = [
                'name'  => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
            ];

            // إذا دخل باسوورد جديد، بنشفره وبنضيفه لمصفوفة التحديث
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->get('password'));
            }

            // تحديث اليوزر المرتبط
            $employee->user()->update($userData);

            return response()->json([
                'icon'  => 'success',
                'title' => 'تم تعديل بيانات الموظف بنجاح!'
            ], 200);
        }

        return response()->json([
            'icon'  => 'error',
            'title' => 'فشل في عملية التعديل'
        ], 400);
    }

   public function destroy($id)
{
    $employee = Employee::findOrFail($id);
    
    // بنحذف اليوزر المرتبط أولاً
    if($employee->user) {
        $employee->user()->delete();
    }
    
    // بعدين بنحذف الموظف
    $isDeleted = $employee->delete();

    return response()->json([
        'icon' => $isDeleted ? 'success' : 'error',
        'title' => $isDeleted ? 'تم الحذف بنجاح' : 'فشل الحذف'
    ], $isDeleted ? 200 : 400);
}
}