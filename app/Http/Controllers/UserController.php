<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLogin;
use App\Http\Requests\RequestUser;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Psy\Util\Json;

class UserController extends Controller
{
    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $userRepository;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['error' => $validator->errors()], '401');
        }
        $user = $this->userRepository->create([
            'email' => $request->email,
            'password' => $request->password,
            'api_token' => Str::random(60)
        ]);

        return new JsonResponse($user, 200);
    }

    /**
     * @param Request $request
     * @return Model|JsonResponse
     */
    public function login(Request $request): Model|JsonResponse
    {
        $validators = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if ($validators->fails()) {
            return new JsonResponse($validators->errors(), '401');
        }
        $user = $this->userRepository->findBy(['email' => $request->email]);
        if ($user && Hash::check($request->password, $user->password)) {
            $user->api_token = Str::random(60);
            $user->save();

            return new JsonResponse($user, 200);
        }

        return new JsonResponse(['error' => 'Username or password invalid.'], '401');
    }
}
