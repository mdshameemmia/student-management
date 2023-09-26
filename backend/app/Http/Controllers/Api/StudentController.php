<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'name'=>'required',
                'roll'=>'required',
                'section'=>'required',
                'class'=>'required',
                'email'=>'required',
                'address'=>'required',
                'mobile'=>'required'
            ]);
            if($validator->fails()){
                return response()->json([
                    'status'=>'400',
                    'errors'=>$validator->errors(),
                    'message'=>'Input field invalid'
                ]);  
            }

          
            Student::create($request->all());
            return response()->json([
                'status'=>'201',
                'message'=>'Successfully stored'
            ]);  

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
