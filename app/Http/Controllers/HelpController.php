<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\HelpCenter;
use Illuminate\Support\Facades\Auth;

class HelpController extends Controller
{
    public function index()
    {
        $Servicesdata = HelpCenter::whereCategory('Services')->get();
        $Generaldata = HelpCenter::whereCategory('General')->get();
        $Accountdata = HelpCenter::whereCategory('Account')->get();
        return view('helpdashboard', compact('Servicesdata', 'Generaldata', 'Accountdata'));
    }
    public function AddFAQData(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'category' => 'required',
         ]);
         DB::beginTransaction();
         try {
            $user = Auth::user();
            $Faquestion = HelpCenter::make();
            $Faquestion->user_id = Auth::id();
            $Faquestion->question = $request->question;
            $Faquestion->answer = $request->answer;
            $Faquestion->category = $request->category;
            $Faquestion->save();
            $action = "FAQ Successfully Added";
            DB::commit();
            Alert::success('Congratulations!', 'FAQ Successfully Added');
            return redirect()->back();
         } catch (\Exception $e) {
            DB::rollback();
            Alert::error('ErrorAlert', $e->getMessage());
            return redirect()->back();
         }
    }
    public function DeleteFAQ($id)
    {
       $faq=HelpCenter::findorfail($id);
       $faq->delete();
       Alert::success('Congratulations!', 'FAQ Item Removed');
       return redirect()->back();
    }
}
