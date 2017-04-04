<?php

namespace Visca\WebTableFan\Diff\Entity;

use Visca\WebTableFan\Entity\Node;

/**
 * Class NodeDeleted
 */
class NodeDeleted
{
    /** @var Node */
    private $node;

    /**
     * NodeDeleted constructor.
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
