<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getemployee()
    {
         return $emp=User::find(1)->employee;
        //  foreach($emp as $val)
        //  {
        //      print_r($val);
        //  }
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->passes()) {

            try{
                $user=new User;
                $user->name=$request->user_name;
                $user->email=$request->email;
                $user->password=Hash::make($request->password);
                $user->save();
                return response()->json(['success'=>'User saved successfully.']);
            }
            catch(\Exception $e){
                // do task when error
                return false;
                // insert query
            }
           
        }
        // return response()->json(['success'=>'User saved successfully.']);
     
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $getdata['data']=User::where('id','>','1')->orderBy('id','DESC')->get();
        echo json_encode($getdata);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        $getdatacustomer = User::destroy($id);
        return response()->json(['success'=>'Delete saved successfully.']);
    }
}
