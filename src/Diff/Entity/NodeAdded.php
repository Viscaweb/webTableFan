<?php

namespace Visca\WebTableFan\Diff\Entity;

use Visca\WebTableFan\Entity\Node\Node;

/**
 * Class NodeAdded.
 */
class NodeAdded
{
    const AFTER = 'after';
    const APPEND = 'append';
    const PREPEND = 'prepend';

    /** @var Node */
    protected $node;

    /** @var string */
    protected $locationId;

    /** @var string append|prepend */
    protected $injectionMethod;

    /**
     * NodeAdded constructor.
     *
     * @param Node   $node
     * @param string $locationId
     * @param string $injectionMethod
     */
    public function __construct(Node $node, $locationId, $injectionMethod)
    {
        $this->node = $node;
        $this->locationId = $locationId;
        $this->injectionMethod = $injectionMethod;
    }

    /**
     * @return Node
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * @return string
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * @return string
     */
    public function getInjectionMethod()
    {
        return $this->injectionMethod;
    }
}
