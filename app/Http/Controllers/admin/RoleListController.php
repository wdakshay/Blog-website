<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RoleListController extends Controller
{
    public function users(){
        $users = User::select('*')->where('role', 0)->get();
        $admin = User::select('*')->where('role', 1)->get();
        return view('admin.users.index', compact('users','admin'));
    }

    public function deleteUser($id){

    }
}
