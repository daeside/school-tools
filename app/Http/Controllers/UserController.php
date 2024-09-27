<?php

namespace App\Http\Controllers;

use App\Commons\Rules;
use App\Commons\Validator;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $size = Validator::getQuerySize($request->query('size'));
            $users = User::orderBy('created_at', 'desc')->paginate($size);
            return response()->json($users, Response::HTTP_OK);
        } catch (Exception $ex) {
            return $this->handleException(null, $ex);
        }
    }

    public function get($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user, Response::HTTP_OK);
        } catch (Exception $ex) {
            return $this->handleException(null, $ex);
        }
    }

    public function create(Request $request)
    {
        try {
            $validated = $request->validate(Rules::USER_RULES);
            $user = $this->buildUser(new User(), $request);
            return response()->json($user, Response::HTTP_CREATED);
        } catch (Exception $ex) {
            return $this->handleException($request, $ex);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate(Rules::USER_RULES);
            $user = $this->buildUser(User::findOrFail($id), $request);
            return response()->json($user, Response::HTTP_OK);
        } catch (Exception $ex) {
            return $this->handleException($request, $ex);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (Exception $ex) {
            return $this->handleException(null, $ex);
        }
    }

    private function buildUser(User $user, Request $request): User
    {
        $user->user = $request->user;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return $user;
    }
}
