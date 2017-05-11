<?php

namespace Visca\WebTableFan\Diff\Entity;

use Visca\WebTableFan\Entity\Node\Node;

/**
 * Class NodeAdded.
 */
class NodeAdded
{
    /** @var Node */
    protected $node;

    /** @var NodePosition */
    protected $nodePosition;

    /**
     * NodeAdded constructor.
     *
     * @param Node         $node
     * @param NodePosition $nodePosition
     */
    public function __construct(Node $node, NodePosition $nodePosition)
    {
        $this->node = $node;
        $this->nodePosition = $nodePosition;
    }

    /**
     * @return Node
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * @return NodePosition
     */
    public function getNodePosition()
    {
        return $this->nodePosition;
    }
}
