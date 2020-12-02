<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminstratorController extends Controller
{
    public function create(){
        //load form view
        return view('gauges.create');
    }

    public function store(Request $request)
    {
        /*$this->validate($request, array(
                'title' => 'required',
                'slug' => 'required',
                'short_description' => 'required',
                'full_content' => 'required',
            )
        );*/

        $input = $request->all();
        Gauge::create($input);
        Session::flash('flash_message', 'A new Gauge is created!');

        //return redirect()->back();
        //return redirect('news');
        return redirect()->route('gauges.index');
    }
    public function edit($id){
        $gauge=DB::table('gauges')->where('id', $id)->first();
        return view('gauges.edit',['gauge'=>$gauge,]);
    }
    //
}
