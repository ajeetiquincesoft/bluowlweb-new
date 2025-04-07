<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\TermCondition;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TermConditionController extends Controller
{
    public function index()
    {
        $data=TermCondition::first();
        return view('TermAndConditions',compact('data'));
    }
    public function AddTermAndConditionData()
    {
        $data=TermCondition::first();

        return view('TermAndConditionData',compact('data'));
    }
    public Function UpdateTermAndCondition(Request $request)
    {
        $data = TermCondition::first();
        if (!$data) {
            $data = new TermCondition();
        }
        $data->user_id = Auth::id();
        $data->title = $request->title;
        $data->content = $request->content;
        $data->save();
       Alert::success('Congratulations!', 'Data has been changed!');
       return redirect()->back();
    }
}
