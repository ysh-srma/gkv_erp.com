<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\User;
use Request;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static function getRecord()
    {
        $return = ClassModel::select('class.*','users.name as created_by_name')
                        ->join('users', 'users.id', '=', 'class.created_by');
                        if (!empty(Request::get('name'))) 
                        {
                            $return = $return->where('class.name', 'like', '%' . Request::get('name') . '%');
                        }
                        if (!empty(Request::get('date'))) 
                        {
                            $return = $return->where('class.created_at', 'like', '%' . Request::get('date') . '%');
                        }
                        
                        
                        $return = $return ->where('class.is_delete', '=', 0)
                        ->orderby('class.id', 'desc')
                        ->paginate(5);
        return $return;
                       
    }

    static public function getClass()
    {
        $return = self::select('class.*')
                        ->join('users', 'users.id', '=', 'class.created_by')
                        ->where('class.is_delete', '=', 0)
                        ->where('class.status', '=', 0)
                        ->orderby('class.name', 'asc')
                        ->get();

                        
        return $return;
    }

    static public function getTotalClass()
    {
        $return = self::select('class.id')
                        ->join('users', 'users.id', '=', 'class.created_by')
                        ->where('class.is_delete', '=', 0)
                        ->where('class.status', '=', 0)
                        ->count();

                        
        return $return;
    }
}
