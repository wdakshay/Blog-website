<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;
use Auth;
use DB;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function updateStatus($table, $id,$value){

        $param = array('status'=>$value);
        $where = array('id' => $id);
        $update = DB::table($table)->where('id',$id)->update($param);

        if($update){
            $action = ($value == 'active')? 'activated' : 'inactivated';
            return redirect()->back()->withStatus('Record has been successfully'.$action);
        }
        else{
            return redirect()->back()->withError("something went wrong, please  try again");
        }
        
    }
}
