<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;

class ServiceCategoriesController extends Controller
{
    public function index(Request $request)
    {
        $service_id = $request->input('service_id');
        $services = Service::get();
        $query = ServiceCategory::query();
        if ($service_id) {
            $query->where('service_id', $service_id);
        }
        $category = $query->get();
        return view('service-categories', compact('services', 'category'));
    }
    public function addCategory(Request $request)
    {
        $request->validate([
            'service_id' => 'required',
            'category_name' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $service = new ServiceCategory();
            $service->service_id  = $request->service_id;
            $service->category_name  = $request->category_name;
            $service->save();
            DB::commit();
            Alert::success('Congratulations!', 'Service Create Succesfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('ErrorAlert', $e->getMessage());
            return redirect()->back();
        }
    }
    public function getCategories(Request $request)
    {
        $categories = ServiceCategory::where('service_id', $request->service_id)->get();
        return response()->json($categories);
    }
    public function editServiceCatogery(Request $request, $id)
    {
        $request->validate([
            'service_id' => 'required',
            'category_name' => 'required',
            'status' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $pricing_id = Crypt::decrypt($id);
            $ServiceCategory = ServiceCategory::findOrFail($pricing_id);
            $ServiceCategory->service_id  = $request->service_id;
            $ServiceCategory->category_name  = $request->category_name;
            $ServiceCategory->status  = $request->status;
            $ServiceCategory->save();
            DB::commit();
            Alert::success('Congratulations!', 'Service Catogery Updated Succesfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('ErrorAlert', $e->getMessage());
            return redirect()->back();
        }
    }
}
