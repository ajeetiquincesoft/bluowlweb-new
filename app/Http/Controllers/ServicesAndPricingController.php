<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
use App\Models\ServiceCategory;
use App\Models\ServicePricing;

class ServicesAndPricingController extends Controller
{
    public function index(Request $request)
    {
        $service_id = $request->input('service_id');
        $category_id = $request->input('category_id');
        $services = Service::get();
        $category = ServiceCategory::get();
        $query = ServicePricing::query();
        if ($service_id) {
            $query->where('service_id', $service_id);
        }
        if ($category_id) {
            $query->where('service_category_id', $category_id);
        }
        $servicepricingdata = $query->with('servicewithpricing', 'categorywithpricing')->paginate(20);
        return view('servicesAndPricing', compact('services', 'category', 'servicepricingdata'));
    }
    public function ourServices()
    {
        $services = Service::orderBy('name', 'asc')->paginate(20);
        return view('ourServices', compact('services'));
    }
    public function addServices(Request $request)
    {
        $request->validate([
            'service_name' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $service = new Service();
            $service->name = $request->service_name;
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
    public function editServices(Request $request, $id)
    {
        $request->validate([
            'service_name' => 'required',
            'status' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $service_id = Crypt::decrypt($id);
            $service = Service::findOrFail($service_id);
            $service->name = $request->service_name;
            $service->status = $request->status;
            $service->save();
            DB::commit();
            Alert::success('Congratulations!', 'Service Updated Succesfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('ErrorAlert', $e->getMessage());
            return redirect()->back();
        }
    }
    public function addServicePricing(Request $request)
    {
        $request->validate([
            'service_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'value' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $service = new ServicePricing();
            $service->service_id  = $request->service_id;
            $service->service_category_id   = $request->category_id;
            $service->Title   = $request->title;
            $service->value   = $request->value;
            $service->save();
            DB::commit();
            Alert::success('Congratulations!', 'Service Pricing Added Succesfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('ErrorAlert', $e->getMessage());
            return redirect()->back();
        }
    }
    public function editServicePricing(Request $request, $id)
    {
        $request->validate([
            'service_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'value' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $pricing_id = Crypt::decrypt($id);
            $service = ServicePricing::findOrFail($pricing_id);
            $service->service_id  = $request->service_id;
            $service->service_category_id   = $request->category_id;
            $service->Title   = $request->title;
            $service->value   = $request->value;
            $service->save();
            DB::commit();
            Alert::success('Congratulations!', 'Service Pricing Updated Succesfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('ErrorAlert', $e->getMessage());
            return redirect()->back();
        }
    }

}
