<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Exception;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // Function destroy digunakan untuk menghapus data
    public function destroy($id)
    {
        $data = Users::findOrFail($id)->delete();
        return ApiFormatter::createApi(200, 'Success Delete');
    }

    public function login(Request $request)
    {
        try
        {
            $data = Users::where('username', '=', $request->username)->where('password', '=', $request->password)->get();
            if ($data)
            {
                return ApiFormatter::createApi(200, 'Success Login', $data);
            }
            else
            {
                return ApiFormatter::createApi(400, 'users/Password Wrong!');
            }
        }
        catch (Exception)
        {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }
}
