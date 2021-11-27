<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Src\Domain\User;
use Src\Domain\User\UserEmail;
use Src\Domain\User\UserName;
use Src\Domain\User\UserPassword;
use Symfony\Component\HttpFoundation\Response;
use Src\Application\UserSignup;

class UserSignupController extends Controller
{
    private const SUCCESS_MESSAGE = "User successfully signed up.";
    private const SUCCESS_STATUS = Response::HTTP_CREATED;
    private const ERROR_STATUS = Response::HTTP_BAD_REQUEST;

    private UserSignup $user_signup;

    public function __construct(UserSignup $registerer)
    {
        $this->user_signup = $registerer;
    }

    /**
     * @throws Exception
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $user = new User(
                new UserName($request->name),
                new UserEmail($request->email),
                new UserPassword($request->password),
            );
            $this->user_signup->signup($user);
            return new JsonResponse(['message' => self::SUCCESS_MESSAGE], self::SUCCESS_STATUS);
        } catch (Exception $error) {
           return new JsonResponse([ 'error' => $error->getMessage() ], self::ERROR_STATUS);
        }
    }
}
