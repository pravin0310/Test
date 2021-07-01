<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeImport;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Models\Employee;
use Auth;
use Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['employeeid']=Employee::max('employee_id');
        if(!empty($data['employeeid']))
        {
            $result=$data['employeeid']+1;
        }else
        {
            $year = date("Y");
            $result=$year.'1';
        }
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getemployee()
    {
        return $emp=Employee::find(1)->user;
    }
    public function create(Request $request)
    {
    
        $validated = $request->validate([
            'importfile' => 'required',
        ]);
       
        $file=$request->file('importfile');
        $format=$file->getClientOriginalExtension();


        $stack=[];   //colum count check
        $stack1=[];
        $var1=array();
        $handle = fopen($file,'r');
        $data = fgetcsv($handle, 1000, ";");
        $var1=array(implode(',',$data));
     
        for($i=0;$i<count($var1);$i++)
        {
            $new=explode(',',$var1[$i]);
            array_push($stack,$new);
        }
        for($i=0;$i<count($stack);$i++)
        {
            $var=count($stack[$i]);
            array_push($stack1,$var);
           
        }    //colum count check End

        // row count check get
        $c =0;
        $fp = fopen($file,"r");
        if($fp){
            while(!feof($fp)){
                $content = fgets($fp);
                
                if($content)    $c++;
                
            }
        }
        fclose($fp);    // row count check get End
        
        if($format =='csv')   // csv Format accepted here
        {
                if($c <='20')    //rows count check 
                {
                      if($stack1[0] >='5')
                      {
                            $import=new EmployeeImport;
                            $rows=Excel::import($import,$request->importfile,null, \Maatwebsite\Excel\Excel::CSV);
                            return back()->with('success','Employee created successfully!');
                      }else
                      {
                        
                        return back()->with('error','Minimum 5 Column Add will be Accept!');

                      }
                       
                }else
                {
                     return back()->with('error','Only 20 rows Accepted!');

                }
        }else
        {
            return back()->with('error','Csv Format Only Accepted!');

        }  
        return response()->json(['error'=>$validated->errors()->all()]);
       
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
            'employee_name' => 'required',
            'employee_department' => 'required',
            'employee_age' => 'required',
            'employee_experience' => 'required',
        ]);
     
        if ($validator->passes()) {
             
            $employee=new Employee;
            $employee->employee_id=$request->employee_code;
            $employee->employee_name=$request->employee_name;
            $employee->employee_department=$request->employee_department;
            $employee->employee_age=$request->employee_age;
            $employee->employee_experience=$request->employee_experience;
            $employee->user_id=$request->userid;
            $employee->save();
            return response()->json(['success'=>'Employee saved successfully.']);
        }
     
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $userid=Auth::user()->id;
        $getdata['data']=Employee::orderBy('id','DESC')->get();
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
        $getdatacustomer = Employee::destroy($id);
        return response()->json(['success'=>'Delete saved successfully.']);
    }
}
