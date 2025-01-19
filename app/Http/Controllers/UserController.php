<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(){
    }

    public function store(Request $request){
    }

    public function update(Request $request, $id){
    }

    public function login(){
    }

    public function delete(Request $request, $id){
        return view('profile.show');
    }
}
