<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use DataTables;  
use JsValidator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\UsersRequest $request)
    {
        $data = new \App\User;

        $data->name= $request->get('name');
        $data->email= $request->get('email');
        $data->password = bcrypt($request->get('password'));
        
        if($data->save()){
            return response()->json(['success' => true, 'msg' => 'User successfully added!']);
        }else{
            return response()->json(['success' => false, 'msg' => 'An error occured while adding user!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::find($id);
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\UpdateUsers $request, $id)
    {
        $data = \App\User::find($id);

        $data->name= $request->get('name');
        $data->email= $request->get('email');
        $data->password = bcrypt($request->get('password'));
        
        if($data->save()){
            return response()->json(['success' => true, 'msg' => 'User successfully added!']);
        }else{
            return response()->json(['success' => false, 'msg' => 'An error occured while adding user!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\App\User::find($id)->delete()) {
            return response()->json(['success' => true, 'msg' => 'User successfully deleted!']);
        } else {
            return response()->json(['success' => false, 'msg' => 'An error occur while trying to remove the User']);
        } 
    }

    public function all(){

        DB::statement(DB::raw('set @row:=0'));
        
        $data = \App\User::selectRaw('*, @row:=@row+1 as row');
        

         return DataTables::of($data)
            ->AddColumn('row', function($column){
               return $column->row;
            })
            ->AddColumn('name', function($column){
               return $column->name;
            })
            ->AddColumn('email', function($column){
               return $column->email;
            }) 
            ->AddColumn('action', function($column){
               return '<div class="dropdown">
                      <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Action
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu" style="min-width: 85px;"> 
                        <li><a href="#" data-id="'.$column->id.'" class="edit-user-btn">Edit</a></li>
                        <li><a href="#" data-id="'.$column->id.'" class="del-user-btn">Delete</a></li>
                      </ul>
                    </div>';
            })
             

            ->make(true);    
    }
}
