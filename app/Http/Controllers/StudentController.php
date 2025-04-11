<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use Hash;
use Auth;
use Str;

class StudentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getStudent();
        $data['header_title'] ="Student List - ";
        return view('admin.student.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] ="Add New Student - ";
        return view('admin.student.add', $data);
    }
    public function insert(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'admission_number' => 'required|unique:users,admission_number',
            'roll_number' => 'required|unique:users,roll_number',
            'moblie_number' => 'max:15|min:10|required|unique:users,moblie_number',
            'password' => 'required|min:6',
            'blood_group' => 'max:10',
            'height' => 'max:10',
            'weight' => 'max:10',
            ]);



        $student = new User();
        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->admission_number = $request->admission_number;
        $student->roll_number = $request->roll_number;
        $student->class_id = $request->class_id;
        $student->gender = $request->gender;
        $student->date_of_birth = $request->date_of_birth;
        $student->caste = $request->caste;
        $student->religion = $request->religion;
        $student->moblie_number = $request->moblie_number;
        $student->admission_date = $request->admission_date;
        if(!empty($request->file('profile_pic')))
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(50);
            $filename = Strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            
            $student->profile_pic = $filename;
        
        }
        else
        {
            $student->profile_pic = '';
        }
        
        $student->blood_group = $request->blood_group;
        $student->height = $request->height;
        $student->weight = $request->weight;
        $student->status = $request->status;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->user_type = 3; // 3 is for student
        $student->created_by = Auth::user()->id;
        $student->is_delete = 0; // 0 means not deleted

        $student->save();
        // Assuming you want to redirect to the student list page after adding a new student
        return redirect('admin/student/list')->with('success', 'Student Added Successfully');

    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['getClass'] = ClassModel::getClass();
            $data['header_title'] ="Edit Student - ";
            return view('admin.student.edit', $data);
        }
        else
        {
            return redirect('admin/student/list')->with('error', 'Student Not Found');
        }
        
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'blood_group' => 'max:10',
            'height' => 'max:10',
            'weight' => 'max:10',
            ]);



        $student = User::getSingle($id);
        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->admission_number = $request->admission_number;
        $student->roll_number = $request->roll_number;
        $student->class_id = $request->class_id;
        $student->gender = $request->gender;
        $student->date_of_birth = $request->date_of_birth;
        $student->caste = $request->caste;
        $student->religion = $request->religion;
        $student->moblie_number = $request->moblie_number;
        $student->admission_date = $request->admission_date;
        if(!empty($request->file('profile_pic')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_pic());
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = Strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            
            $student->profile_pic = $filename;
        
        }
        else
        {
            $student->profile_pic = '';
        }
        
        $student->blood_group = $request->blood_group;
        $student->height = $request->height;
        $student->weight = $request->weight;
        $student->status = $request->status;
        $student->email = $request->email;
        if(!empty($request->password))
        {
            $student->password = Hash::make($request->password);
        }
       
      
        
        $student->save();
        // Assuming you want to redirect to the student list page after updating a new student
        return redirect('admin/student/list')->with('success', 'Student Added updated');
    }

    public function delete($id)
    {
        $student = User::getSingle($id);
        if (!empty($student)) {
            $student->is_delete = 1; // 1 means deleted
            $student->save();
            return redirect('admin/student/list')->with('success', 'Student Deleted Successfully');
        } else {
            return redirect('admin/student/list')->with('error', 'Student Not Found');
        }
    }

}
