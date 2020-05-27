<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Firebase\JWT\JWT;

class LoginAuthenticator extends AbstractGuardAuthenticator
{

    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function supports(Request $request)
    {
        return $request->get("_route") === "api_login" && $request->isMethod("POST");
    }

    public function getCredentials(Request $request)
    {
        return [
            'username' => $request->request->get("username"),
            'password' => $request->request->get("password")
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials['username']);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse([

            'status' => "false",
            'message' => $exception->getMessageKey()
        ]);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {

        $expireTime = time() + 3600;
        $tokenPayload = [
            'user_id' => $token->getUser()->getId(),
            'username'   => $token->getUser()->getUsername(),
            'exp'     => $expireTime
        ];
        $jwt = JWT::encode($tokenPayload, getenv("JWT_SECRET"));
                return new JsonResponse([
                    'status' => "true",
                    'message' => "Login Successfull",
                    'token'=>$jwt
        ], 200);
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse([
            'status' => "false",
            'message' => "Access Denied",
            
        ]);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
