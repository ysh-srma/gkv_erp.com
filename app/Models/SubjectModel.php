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

class SubjectModel extends Model
{
    use HasFactory;
    protected $table = 'subject';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static function getRecord()
    {

        $return = SubjectModel::select('subject.*','users.name as created_by_name')
                        ->join('users', 'users.id', '=', 'subject.created_by');
                        if (!empty(Request::get('name'))) 
                        {
                            $return = $return->where('subject.name', 'like', '%' . Request::get('name') . '%');
                        }
                        if (!empty(Request::get('type'))) 
                        {
                            $return = $return->where('subject.type', 'like', '%' . Request::get('type') . '%');
                        }
                        if (!empty(Request::get('date'))) 
                        {
                            $return = $return->where('subject.created_at', 'like', '%' . Request::get('date') . '%');
                        }
                        
                        
                        $return = $return ->where('subject.is_delete', '=', 0)
                        ->orderby('subject.id', 'desc')
                        ->paginate(5);
        return $return;
                       
    }

    static public function getTotalSubject()
    {
        $return = SubjectModel::select('subject.id')
                        ->join('users', 'users.id', '=', 'subject.created_by')
                        ->where('subject.is_delete', '=', 0)
                        ->count();

                        
        return $return;
    }
}
