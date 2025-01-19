<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Face;
use App\Models\User;

class FaceController extends Controller
{
    public function create()
    {
        return view('face.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descriptor' => 'required|array'
        ]);

        try {
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
        } catch (\Exception $e) {
            Log::error("Erro ao salvar rosto: {$e->getMessage()}");
            return redirect()->back()->withErrors('Erro ao registrar o rosto. Tente novamente.');
        }
    }

    public function edit(){
        return view('face.edit');
    }

    public function update(Request $request, $id){
        
        $request->validate([
            'descriptor' => 'required|array'
        ]);

        try {
            $descriptor = $request->input('descriptor');

            // Salvar o rosto
            $faceData = Face::findOrFail($id);
            $faceData->user_id = auth()->id();
            $faceData->descriptor = json_encode($descriptor);
            $faceData->update();

            // Associar o face_id ao usuário autenticado
            $user = Auth::user();
            $user->face_id = $faceData->id;
            $user->update();

            return redirect('/dashboard')->with('success', 'Rosto atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao salvar rosto: {$e->getMessage()}");
            return redirect()->back()->withErrors('Erro ao atualizar o rosto. Tente novamente.');
        }
    }

    public function delete($id){
        try {
            $face = Face::findOrdFail($id);
            $face->forceDelete();

            return redirect('/dashboard')->with('success', 'Rosto deletado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao deletar rosto: {$e->getMessage()}");
            return redirect()->back()->withErrors('Erro ao deletar o rosto. Tente novamente.');
        }
    }

    public function showFaceLogin(){
        return view('face.login');
    }

    public function faceLogin(Request $request)
    {
        $request->validate(['descriptor' => 'required']);

        try {
            // Obter o descritor de entrada
            $inputDescriptor = is_string($request->input('descriptor'))
                ? json_decode($request->input('descriptor'), true)
                : $request->input('descriptor');

            Log::info('Descritor facial recebido:', $inputDescriptor);

            // Obter todos os usuários com descritores faciais
            $users = User::with('face')->get();

            if ($users->isEmpty()) {
                Log::warning('Nenhum usuário com descritor facial encontrado.');
                return response()->json(['error' => 'Nenhum usuário registrado para login facial.'], 404);
            }

            foreach ($users as $user) {
                $storedDescriptor = is_string($user->face->descriptor)
                    ? json_decode($user->face->descriptor, true)
                    : $user->face->descriptor;

                if ($this->compareFace($inputDescriptor, $storedDescriptor)) {
                    Auth::login($user);

                    $token = $user->createToken('YourAppName')->plainTextToken;

                    Log::info('Usuário autenticado com sucesso.', ['user_id' => $user->id]);

                    return response()->json([
                        'token' => $token,
                        'user' => $user
                    ]);
                }
            }

            Log::warning('Falha no login facial. Nenhum rosto correspondente encontrado.');
            return response()->json(['error' => 'Rosto não reconhecido.'], 401);
        } catch (\Exception $e) {
            Log::error("Erro no login facial: {$e->getMessage()}");
            return response()->json(['error' => 'Erro no servidor.'], 500);
        }
    }

    private function compareFace($inputDescriptor, $storedDescriptor)
    {
        $threshold = 0.6; // Valor de tolerância para reconhecimento
        $distance = $this->euclideanDistance($inputDescriptor, $storedDescriptor);

        Log::info("Distância calculada: {$distance}, Limiar: {$threshold}");

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
