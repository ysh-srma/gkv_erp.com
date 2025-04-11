<?php

namespace App\Http\Controllers;
use Hash;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getAdmin();
        $data['header_title'] ="Admin List - ";
        return view('admin.admin.list', $data);
    }

    public function add()
    {
        
        $data['header_title'] ="Add New Admin   - ";
        return view('admin.admin.add', $data);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) 
        {
            return redirect('admin/admin/add')->with('error', 'Email Already Exist');
        }
     
       $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();
        return redirect('admin/admin/list')->with('success', 'Admin Added Successfully');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::find($id);
        if (!empty($data['getRecord'])) 
        {
        $data['header_title'] ="Admin Edit - ";
        return view('admin.admin.edit', $data);
        }
        else
        {
            return redirect('admin/admin/list')->with('error', 'Admin Not Found');
        }
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::find($id);
        if (!empty($user)) 
        {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password != '') 
            {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return redirect('admin/admin/list')->with('success', 'Admin Updated Successfully');
        }
        else
        {
            return redirect('admin/admin/list')->with('error', 'Admin Not Found');
        }
    }



    public function delete($id)
    {
        $user = User::find($id);
        if (!empty($user)) 
        {
            $user->is_delete = 1;
            $user->save();
            return redirect('admin/admin/list')->with('success', 'Admin Deleted Successfully');
        }
        else
        {
            return redirect('admin/admin/list')->with('error', 'Admin Not Found');
        }
    }

    public function view($id)
    {
        $data['getRecord'] = User::find($id);
        if (!empty($data['getRecord'])) 
        {
            $data['header_title'] ="Admin View - ";
            return view('admin.admin.view', $data);
        }
        else
        {
            return redirect('admin/admin/list')->with('error', 'Admin Not Found');
        }
    }

}
