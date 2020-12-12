<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
        $this->validator($request);

        DB::beginTransaction();
        try {

            $profile = Profile::create([
                'name' => $request->input('name')
            ]);

            if (!is_null($request->input('permissions')))
                foreach ($request->input('permissions') as $permission) {
                    $permission = Permission::findByUuid($permission);
                    $permission->profiles()->attach($profile->id);
                }

            DB::commit();
            return redirect()->route('admin.profiles.home')->with(['message' => 'Perfil inserido com sucesso']);

        } catch (\Exception $err) {

            DB::rollBack();
            return redirect()->route('admin.profiles.home')->with(['error' => true, 'message' => 'Falha na tentativa de criar perfil, tente novamente']);

        }
    }

    public function update(Request $request, string $uuid)
    {
        $this->validator($request);
        $profile = Profile::findByUuid($uuid);

        DB::beginTransaction();
        try {

            $profile->update([
                'name' => $request->input('name')
            ]);

            $profile->permissions()->detach();

            if (!is_null($request->input('permissions')))
                foreach ($request->input('permissions') as $permission) {
                    $permission = Permission::findByUuid($permission);
                    $permission->profiles()->attach($profile->id);
                }

            DB::commit();
            return redirect()->route('admin.profiles.home')->with(['message' => 'Perfil editado com sucesso']);

        } catch (\Exception $err) {

            DB::rollBack();
            return redirect()->route('admin.profiles.home')->with(['error' => true, 'message' => 'Falha na tentativa de editar perfil, tente novamente']);

        }
    }

    public function destroy(string $uuid)
    {
        $profile = Profile::findByUuid($uuid);

        DB::beginTransaction();

        try {

            $profile->permissions()->detach();
            $profile->delete();

            DB::commit();
            return redirect()->route('admin.profiles.home')->with(['message' => 'Perfil excluído com sucesso']);

        } catch (\Exception $err) {

            DB::rollBack();
            return redirect()->route('admin.profiles.home')->with(['error' => true, 'message' => 'Falha na tentativa de excluir perfil, tente novamente']);

        }

    }

    private function validator(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'string']
        ]);
    }
}
