<?php

namespace App\Http\Controllers\api;

use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class MeController extends Controller
{
    use HasRoles;

    public function index(Request $request)
    {
        $user = $request->user();

        if (isset($user->avatar_id)) {
            $avatar = File::where('id', $user->avatar_id)->first();
        } else {
            $avatar = File::where('id', 1)->first();
        }
        $user->avatar_path = $avatar->path;

        (!empty(auth()->user()->getAllPermissions())) ? auth()->user()->getAllPermissions() : false;
        (!empty(auth()->user()->getRoleNames())) ? auth()->user()->getRoleNames() : false;

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }
}
