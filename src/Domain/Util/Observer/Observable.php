<?php

namespace Javier\Cineja\Domain\Util\Observer;

interface Observable
{
    public function attach(Observer $observer);
    public function notify();
}
