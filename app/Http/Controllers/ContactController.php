<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('welcome');
    }


    public function getData()
    {
        return Contact::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Contact::create($request->all());
        return ["success"=>true, "message"=>"Data successfully inserted"];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->has('id')) {
            Contact::find($request->input('id'))->update($request->all());
            return ["success"=>true, "message"=>"Data successfully updated"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')){
            Contact::find($request->input('id'))->delete();
            return ["success"=>true, "message"=>"Data successfully deleted"];
        }
    }
}
