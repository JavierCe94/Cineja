<?php

namespace Javier\Cineja\Infrastructure\JwtToken;

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Javier\Cineja\Domain\Model\JwtToken\ExpiredTokenException;
use Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException;
use Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException;
use Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException;
use Javier\Cineja\Domain\Model\JwtToken\JwtToken;
use Javier\Cineja\Domain\Model\JwtToken\JwtTokenClass as JwtTokenClassInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class JwtTokenClass implements JwtTokenClassInterface
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function createToken(string $role, array $data): string
    {
        $time = time();
        $token = [
            'iat' => $time,
            'exp' => $time + JwtToken::ONE_DAY,
            'aud' => $this->audience(),
            'role' => $role,
            'data' => $data
        ];
        $token = JWT::encode($token, JwtToken::KEY);

        return $token;
    }

    /**
     * @param array $roles
     * @return mixed
     * @throws ExpiredTokenException
     * @throws InvalidRoleTokenException
     * @throws InvalidTokenException
     * @throws InvalidUserTokenException
     */
    public function checkToken(array $roles)
    {
        $token = $this->requestStack->getCurrentRequest()->headers->get('X-AUTH-TOKEN');
        if (null === $token) {
            throw new InvalidTokenException();
        }
        try {
            $decode = JWT::decode(
                $token,
                JwtToken::KEY,
                JwtToken::TYPE_ENCRYPT
            );
        } catch (ExpiredException $exception) {
            throw new ExpiredTokenException();
        }

        if (false === in_array($decode->role, $roles)) {
            throw new InvalidRoleTokenException();
        }
        if ($this->audience() !== $decode->aud) {
            throw new InvalidUserTokenException();
        }

        return $decode->data;
    }

    private function audience(): string
    {
        $server = $this->requestStack->getCurrentRequest()->server;
        switch (true) {
            case null !== $server->get('HTTP_CLIENT_IP'):
                $aud = $server->get('HTTP_CLIENT_IP');
                break;
            case null !== $server->get('HTTP_X_FORWARDED_FOR'):
                $aud = $server->get('HTTP_X_FORWARDED_FOR');
                break;
            default:
                $aud = $server->get('REMOTE_ADDR');
        }
        $aud .= @$server->get('HTTP_USER_AGENT');
        $aud .= gethostname();

        return sha1($aud);
    }
}
