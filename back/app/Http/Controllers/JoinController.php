<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Join;
class JoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getJoins()
    {
        return Join::with('user','myevent')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $join = new Join();
        $join->myevent_id = $request->myevent_id;
        $join->user_id = $request->user_id;
        $join->save();
        return response()->json(["message" => "created", 'data' => $join], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $isDeleted = Join::destroy($id);
        if($isDeleted == 1){
            return response()->json(['massage'=>'Deleted'], 200);
        }else{
            return response()->json(['massage'=>'Not Found'], 404);
        }
    }
}