<?php

namespace Javier\Cineja\Infrastructure\Event;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $jsonResponse = new JsonResponse(
            $exception->getMessage(),
            100 <= $exception->getCode() ? $exception->getCode() : HttpResponses::BAD_REQUEST
        );
        $event->setResponse($jsonResponse);
    }
}
