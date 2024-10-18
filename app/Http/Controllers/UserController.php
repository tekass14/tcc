<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(){
        return view('face.create');
    }

    public function store(Request $request){
        
        return redirect('/')->with('sucess', 'Face cadastrada com sucesso!');
    }

    public function update(Request $request, $id){
        
    }

    public function edit(){
        return view('face.edit', ['id' -> $id]);
    }

    public function login(){
        return view('face.login');
    }

    public function delete(Request $request, $id){
        
        return view('profile.show');
    }
}
