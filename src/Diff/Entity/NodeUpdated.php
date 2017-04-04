<?php

namespace Visca\WebTableFan\Diff\Entity;

use Visca\WebTableFan\Entity\Node;

/**
 * Class NodeUpdated
 */
class NodeUpdated
{
    /** @var Node */
    protected $node;

    /**
     * NodeUpdated constructor.
     *
     * @param Node $node
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * @return Node
     */
    public function getNode()
    {
        return $this->node;
    }
}
