<?php

namespace App\Http\Controllers;

use App\Helpers\GetPermissionsHelper;
use App\Models\Invoice;
use App\Models\Permission;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $permissions = $this->getPermissions();
        $counts = ['users' => User::all()->count(), 'profiles' => Profile::all()->count(), 'invoices' => Invoice::all()->count()];
        return View('admin.home')->with(compact('permissions', 'counts'));
    }

    public function users()
    {
        $permissions = $this->getPermissions();
        $users = User::with(['profile'])->get();
        return View('admin.users.list')->with(compact('permissions', 'users'));
    }

    public function showUser(String $uuid)
    {
        $permissions = $this->getPermissions();
        $user = User::findByUuid($uuid);
        return View('admin.users.details')->with(compact('permissions', 'user'));
    }

    public function editUser(String $uuid)
    {
        $permissions = $this->getPermissions();
        $user = User::findByUuid($uuid, ['profile']);
        $profiles = Profile::all();
        return View('admin.users.edit')->with(compact('permissions', 'user', 'profiles'));
    }

    public function createUser()
    {
        $permissions = $this->getPermissions();
        $profiles = Profile::all();
        return View('admin.users.create')->with(compact('permissions', 'profiles'));
    }

    public function profiles()
    {
        $permissions = $this->getPermissions();
        $profiles = Profile::all();
        return View('admin.profiles.list')->with(compact('permissions', 'profiles'));
    }

    public function showProfile(string $uuid)
    {
        $permissions = $this->getPermissions();
        $profile = Profile::findByUuid($uuid, ['permissions']);
        return View('admin.profiles.details')->with(compact('permissions', 'profile'));
    }

    public function createProfile()
    {
        $permissions = $this->getPermissions();
        $permissionsToSync = Permission::all();
        return View('admin.profiles.create')->with(compact('permissions', 'permissionsToSync'));
    }

    public function editProfile(string $uuid)
    {
        $permissions = $this->getPermissions();
        $permissionsToSync = Permission::all();
        $profile = Profile::findByUuid($uuid, ['permissions']);
        $permissionsToProfile = GetPermissionsHelper::getPermissionsToProfile($profile);
        return View('admin.profiles.edit')->with(compact('permissions', 'permissionsToSync', 'profile', 'permissionsToProfile'));
    }

    public function invoices()
    {
        $permissions = $this->getPermissions();
        $invoices = Invoice::with('user')->get();
        return View('admin.invoices.list')->with(compact('permissions', 'invoices'));
    }

    public function showInvoice(string $uuid)
    {
        $permissions = $this->getPermissions();
        $invoice = Invoice::findByUuid($uuid, ['user']);
        $invoiceImage = asset("assets/uploads/nf/{$invoice->invoice}");
        return View('admin.invoices.details')->with(compact('permissions', 'invoice', 'invoiceImage'));
    }
}
