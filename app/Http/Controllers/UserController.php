<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use App\Models\User;
use DB;
use Auth;

class UserController extends Controller
{
    //*** Historial ***//
    function index(){
        $usuarios = User::withCount('courses', 'events')
                        ->where('rol', '=', 2)
                        ->orderBy('name', 'ASC')
                        ->get();

        return view('admin.usersRecord')->with(compact('usuarios'));
    }
}
