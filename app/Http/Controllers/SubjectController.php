<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use App\Models\SubjectModel;

class SubjectController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SubjectModel::getRecord();
        $data['header_title'] ="Subject List - ";
        return view('admin.subject.list',$data);
    }
    public function add()
    {
        $data['header_title'] =" New Add subject - ";
        return view('admin.subject.add',$data);
    }

    public function insert(Request $request)
    {
        $save = new SubjectModel();
        $save->name = $request->name;
        $save->type = $request->type;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->created_at = date('Y-m-d H:i:s');
        $save->updated_at = date('Y-m-d H:i:s');
        $save->save();

        return redirect('admin/subject/list')->with('success', 'subject added successfully.');

    }
    public function edit($id)
    {
        $data['getRecord'] = SubjectModel::find($id);
        if (!empty($data['getRecord'])) 
        {
            $data['header_title'] ="subject Edit - ";
            return view('admin.subject.edit',$data);
        }
        else
        {
            return redirect('admin/subject/list')->with('error', 'subject Not Found');
        }
    }
    public function update(Request $request, $id)
    {
        $update = SubjectModel::find($id);
        $update->name = $request->name;
        $update->type = $request->type;
        $update->status = $request->status;
        $update->updated_at = date('Y-m-d H:i:s');
        $update->save();

        return redirect('admin/subject/list')->with('success', 'subject updated successfully.');
    }
    public function delete($id)
    {
        $save = SubjectModel::find($id);
        $save->is_delete = 1;
        $save->updated_at = date('Y-m-d H:i:s');
        $save->save();
        return redirect('admin/subject/list')->with('success', 'subject deleted successfully.');
       
    }
}
