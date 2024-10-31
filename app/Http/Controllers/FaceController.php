<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Face;
use App\Models\User;

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
        $faceData->user_id = auth()->id();
        $faceData->descriptor = json_encode($descriptor); 
        $faceData->save();

        // Associar o face_id ao usuário autenticado
        $user = Auth::user(); 
        $user->face_id = $faceData->id; 
        $user->save(); 

        return redirect('/dashboard')->with('success', 'Rosto registrado com sucesso!');
    }

    public function edit($id)
    {
        $face = Face::findOrFail($id);
        return view('face.edit', ['face' => $face]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descriptor' => 'required|array'
        ]);

        $descriptor = $request->input('descriptor');

        $faceData = Face::findOrFail($id);
        $faceData->descriptor = json_encode($descriptor); 
        $faceData->save();

        return redirect('/dashboard')->with('success', 'Rosto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $face = Face::findOrFail($id);
        $face->delete();

        return redirect('/dashboard')->with('success', 'Rosto apagado com sucesso!');
    }

    public function showFaceLogin()
    {
        return view('face.login');
    }

    public function faceLogin(Request $request)
{
    $request->validate(['descriptor' => 'required']);

    $inputDescriptor = is_string($request->input('descriptor'))
        ? json_decode($request->input('descriptor'), true)
        : $request->input('descriptor');

    Log::info('Input Descriptor:', $inputDescriptor);

    $users = User::with('face')->get();

    if ($users->isEmpty()) {
        Log::warning('No users found for face login.');
    }

    foreach ($users as $user) {
        $storedDescriptor = is_string($user->face->descriptor)
            ? json_decode($user->face->descriptor, true)
            : $user->face->descriptor;

        if ($this->compareFace($inputDescriptor, $storedDescriptor)) {
            Auth::login($user);

            $token = $user->createToken('YourAppName')->plainTextToken;

            Log::info('User logged in:', ['user_id' => $user->id, 'token' => $token]);

            return response()->json([
                'success' => 'Bem-vindo, ' . $user->name,
                'token' => $token,
                'user' => $user
            ]);
        }
    }

    Log::warning('Face login failed for descriptor: ', $inputDescriptor);
    return response()->json(['error' => 'Rosto não reconhecido.'], 401);
}






    private function compareFace($inputDescriptor, $storedDescriptor)
    {
        $threshold = 0.6; // Valor de tolerância para reconhecimento
        $distance = $this->euclideanDistance($inputDescriptor, $storedDescriptor);
        return $distance < $threshold;
    }

    private function euclideanDistance($a, $b)
    {
        $sum = 0;
        for ($i = 0; $i < count($a); $i++) {
            $sum += ($a[$i] - $b[$i]) ** 2;
        }
        return sqrt($sum);
    }
}
