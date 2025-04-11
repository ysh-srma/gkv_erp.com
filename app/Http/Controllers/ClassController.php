<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use App\Models\ClassModel;

class ClassController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ClassModel::getRecord();
        $data['header_title'] ="Class List - ";
        return view('admin.class.list',$data);
    }
    public function add()
    {
        $data['header_title'] =" New Add Class - ";
        return view('admin.class.add',$data);
    }

    public function insert(Request $request)
    {
        $save = new ClassModel();
        $save->name = $request->name;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->created_at = date('Y-m-d H:i:s');
        $save->updated_at = date('Y-m-d H:i:s');
        $save->save();

        return redirect('admin/class/list')->with('success', 'Class added successfully.');

    }
    public function edit($id)
    {
        $data['getRecord'] = ClassModel::find($id);
        if (!empty($data['getRecord'])) 
        {
            $data['header_title'] ="Class Edit - ";
            return view('admin.class.edit',$data);
        }
        else
        {
            return redirect('admin/class/list')->with('error', 'Class Not Found');
        }
    }
    public function update(Request $request, $id)
    {
        $update = ClassModel::find($id);
        $update->name = $request->name;
        $update->status = $request->status;
        $update->updated_at = date('Y-m-d H:i:s');
        $update->save();

        return redirect('admin/class/list')->with('success', 'Class updated successfully.');
    }
    public function delete($id)
    {
        $save = ClassModel::find($id);
        $save->is_delete = 1;
        $save->updated_at = date('Y-m-d H:i:s');
        $save->save();
        return redirect('admin/class/list')->with('success', 'Class deleted successfully.');
       
    }

}
