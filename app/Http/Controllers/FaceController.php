<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Face;
use Illuminate\Support\Facades\Auth; 

class FaceController extends Controller
{

    public function create(){
        return view('face.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'descriptor' => 'required|array'
        ]);

        $descriptor = $request->input('descriptor');

        // Salvar o rosto
        $faceData = new Face();
        $faceData->descriptor = json_encode($descriptor); // Salvar como JSON
        $faceData->save();

        // Associar o face_id ao usuário autenticado
        $user = Auth::user(); // Obter o usuário autenticado
        $user->face_id = $faceData->id; // Atribuir o ID do rosto ao usuário
        $user->save(); // Salvar o usuário

        return redirect('/dashboard')->with('success', 'Rosto registrado com sucesso!');
    }

    public function edit(string $id)
    {
        return view('face.edit');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
