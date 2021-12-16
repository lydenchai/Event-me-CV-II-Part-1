<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Myevent;
use App\Http\Resources\MyeventResource;

class MyeventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Myevent::with('category','join')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'=>'required',
            'user_id'=>'required',
            'title'=>'required',
            'start_date'=>'required',
            'end_date'=>'required|after:start_date',
            'city'=>'required',
            'country'=>'required',
            'description'=>'nullable',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,gif,jfif|max:1999'
        ]);
        
        $request -> file('image')->store('public/images');

        $myevent = new Myevent();
        $myevent->category_id = $request->category_id;
        $myevent->user_id = $request->user_id;
        $myevent->title = $request->title;
        $myevent->start_date = $request->start_date;
        $myevent->end_date = $request->end_date;
        $myevent->city = $request->city;
        $myevent->country = $request->country;
        $myevent->description = $request->description;
        $myevent->image =$request->file('image')->hashName();
        $myevent->save();
        return response()->json([
            'Message' => 'My event created',
            'data' =>Myevent::with(['category'])->latest()->first(),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Myevent::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id'=>'required',
            'user_id'=>'required',
            'title'=>'required',
            'start_date'=>'required',
            'end_date'=>'required|after:start_date',
            'city'=>'required',
            'country'=>'required',
            'description'=>'nullable',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,gif,jfif|max:1999'
        ]);

        $request -> file('image')->store('public/images');
        $myevent = Myevent::findOrFail($id);
        $myevent->category_id = $request->category_id;
        $myevent->user_id = $request->user_id;
        $myevent->title = $request->title;
        $myevent->start_date = $request->start_date;
        $myevent->end_date = $request->end_date;
        $myevent->city = $request->city;
        $myevent->country = $request->country;
        $myevent->description = $request->description;
        $myevent->image =$request->file('image')->hashName();
        $myevent->save();
         return response()->json([
            'Message' => 'My event updated',
            'data' => $myevent
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = Myevent::destroy($id);
        if($isDeleted == 1){
            return response()->json(['massage'=>'Deleted'], 200);
        }else{
            return response()->json(['massage'=>'Not Found'], 404);
        }
    }
    public function search($title)
    {
        return MyEvent::where('title','like', '%'.$title.'%')->with(["category", "join"])->get();
    }
    public function searchCity($city)
    {
        return MyEvent::where('city','like', '%'.$city.'%')->with(["category", "join"])->get();
    }
}