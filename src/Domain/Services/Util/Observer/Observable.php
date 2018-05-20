<?php

namespace Javier\Cineja\Domain\Services\Util\Observer;

interface Observable
{
    public function attach(Observer $observer);
    public function notify();
}
