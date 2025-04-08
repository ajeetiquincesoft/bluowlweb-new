<?php

namespace App\Http\Controllers;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $data = PrivacyPolicy::first();
        return view('PrivacyPolicy', compact('data'));
    }
    public function PrivacyPolicyData()
    {
        $data = PrivacyPolicy::first();
        return view('PrivacyPolicydata', compact('data'));
    }
    public function UpdatePrivacyPolicyData(Request $request)
    {
        $data = PrivacyPolicy::first();
        if (!$data) {
            $data = new PrivacyPolicy();
        }
        $data->user_id = Auth::user()->id;
        $data->title = $request->title;
        $data->content = $request->content;
        $data->save();
        Alert::success('Congratulations!', 'Data has been changed!');
        return redirect()->back();
    }
}
