<?php

namespace Javier\Cineja\Infrastructure\Util\Specification;

use Doctrine\ORM\QueryBuilder;
use Javier\Cineja\Domain\Model\Specification\Specification;

class AsArray implements Specification
{
    private $parent;

    public function __construct(Specification $parent)
    {
        $this->parent = $parent;
    }

    public function match(QueryBuilder $qb)
    {
        return $this->parent->match($qb);
    }
}
