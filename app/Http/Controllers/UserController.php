<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function store(Request $request)
    {
        $this->validator($request);
        $profile = Profile::findByUuid($request->input('profile'));

        DB::beginTransaction();

        try {

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'cpf' => $this->onlyNumbers($request->input('cpf')),
                'password' => Hash::make($request->input('password')),
                'profiles_id' => $profile->id
            ]);

            DB::commit();

            return redirect()->route('admin.users.create')->with([ 'message' => 'Usuário cadastrado com sucesso' ]);

        } catch (\Exception $err) {

            DB::rollBack();

            return redirect()->route('admin.users.create')->with([ 'error' => true, 'message' => 'Falha na tentativa de inserir usuário, tente novamente' ]);

        }
    }

    public function update(Request $request, string $uuid)
    {
        $this->validator($request, true);
        $user = User::findByUuid($uuid);
        $profile = Profile::findByUuid($request->input('profile'));

        DB::beginTransaction();

        try {

            $user->update([
                'name' => $request->input('name'),
                'profiles_id' => $profile->id
            ]);

            DB::commit();

            return redirect()->route('admin.users.edit', ['uuid' => $user->uuid])->with([ 'message' => 'Usuário cadastrado com sucesso' ]);

        } catch (\Exception $err) {

            DB::rollBack();

            return redirect()->route('admin.users.edit', ['uuid' => $user->uuid])->with([ 'error' => true, 'message' => 'Falha na tentativa de inserir usuário, tente novamente' ]);

        }
    }

    public function destroy(string $uuid)
    {
        $user = User::findByUuid($uuid);
        try {

            $user->delete();

            return redirect()->route('admin.users.home')->with(['message' => 'Usuário excluído com sucesso ']);

        } catch (\Exception $e) {

            return redirect()->route('admin.users.home')->with(['error' => true, 'message' => 'Falha na tentativa de excluir usuário, tente novamente ']);

        }
    }

    private function validator(Request $request, bool $update = false)
    {

        if ($update)
            return $request->validate([
                'name' => ['required', 'string'],
                'profile' => ['required']
            ]);

        return $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'cpf' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
            'profile' => ['required']
        ]);
    }
}
