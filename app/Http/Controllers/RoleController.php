<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    public function index() 
    {
        //membuat variable role kemudian mengambil seluruh data yang ada pada model role 
        $role = role::all();

        //memberikan response kepada FE menggunakan JSON dengan memanggil variable(role) yang sudah dibuat 
        // 'data' itu key untuk menyimpan value yang ada pada variable $role
        //return response()->json(['data' => $role]);   

        return RoleResource::collection($role);
    }
}
