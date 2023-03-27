<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\FIle;


class EmployeeController extends Controller
{
    public function index() {
        
        $employees = Employee::orderBy('id','DESC')->get();

        return view('employee.list',['employees' => $employees]);
    }

    public function create() {

        return view('employee.create');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(),[

            'name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
            'gender' => 'required|in:Male,Female',
            'mobile' => 'required|numeric|unique:employees,mobile' ,
            'email' => 'required|email|unique:employees,email' ,
            'hobbies' => 'nullable',
            'status' => 'required|in:Active,InActive',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
        ]);

        if ( $validator->passes()) {
           
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->gender = $request->gender;
            $employee->mobile = $request->mobile;
            $employee->address = $request->address;
            $employee->email = $request->email;
            $employee->hobbies = $request->hobbies;
            $employee->status = $request->status;
            $employee->save();

            if($request->image) {
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/employees/',$newFileName); //for saving image in location
                $employee->image = $newFileName;
                $employee->save();
            
            }

            $request->session()->flash('success','Details Added Successfully');

            return redirect()->route('employees.index');

        } 
        else{

            return redirect()->route('employees.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id){

        $employee = Employee::findOrFail($id);

        return view('employee.edit',['employee' => $employee]);
    }

    public function update($id, Request $request) {
        // dd($id);
        // $validator = Validator::make($request->all(),[

        //     'name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
        //     'gender' => 'required|in:Male,Female',
        //     'mobile' => 'required|numeric|' ,
        //     'email' => 'required|email|' ,
        //     'hobbies' => 'nullable',
        //     'status' => '   in:Active,InActive',
        //     'image' => 'image|mimes:jpeg,png|max:2048',
        // ]);

        // if ( $validator->passes()) {
           
            $employee = Employee::find($id);
            $employee->name = $request->name;
            $employee->gender = $request->gender;
            $employee->mobile = $request->mobile;
            $employee->address = 'sdsd';
            $employee->email = $request->email;
            $employee->hobbies = $request->hobbies;
            $employee->status = "Active";
            $employee->save();

            // if($request->image) {
            //     $oldImage = $employee->image;
            //     $ext = $request->image->getClientOriginalExtension();
            //     $newFileName = time().'.'.$ext;
            //     $request->image->move(public_path().'/uploads/employees/',$newFileName); //for saving image in location
            //     $employee->image = $newFileName;
            //     $employee->save();
            
            //     File::delete(public_path().'/uploads/employees/'.$oldImage);

            // }

            // $request->session()->flash('success','Details Added Successfully');

            return redirect()->route('employees.index');

        // } 
        // else{

        //     return redirect()->route('employees.edit',$id)->withErrors($validator)->withInput();
        // }

    }

    public function destroy($id, Request $request){

        $employee = Employee::findOrfail($id);
        File::delete(public_path().'/uploads/employees/'.$employee->image);
        $employee->delete();

        $request->session()->flash('success','Employee Details are deleted');
        return redirect()->route('employees.index');
    }

    public function show($id){

        $employee = Employee::findOrFail($id);

        return view('employee.show',['employee' => $employee]);
    }
}
