<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = User::paginate(5);
        return Response::json($data, \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }

    public function show(User $user)
    {
        return Response::json($user, \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }

    public function update(UserUpdateRequest $request,User $user)
    {
        $user->update($request->all());

        return Response::json([
            'success' => true,
            'message' => 'User Updated successfully',
            'data' => $user
        ], \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User Deleted successfully',
            'data' => $user
        ], \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }
}
