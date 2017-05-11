<?php

namespace Visca\WebTableFan\Events;

use Symfony\Component\EventDispatcher\Event;
use Visca\WebTableFan\Entity\Node\Node;

/**
 * Class TableNodesCreatedEvent.
 */
class TableNodesCreatedEvent extends Event
{
    /** @var Node */
    private $tableNode;

    /** @var string */
    private $tableVersion;

    /**
     * TableNodesCreatedEvent constructor.
     *
     * @param string $tableVersion
     * @param Node   $tableNode
     */
    public function __construct(Node $tableNode, $tableVersion)
    {
        $this->tableNode = $tableNode;
        $this->tableVersion = $tableVersion;
    }

    /**
     * @return Node
     */
    public function getTableNode()
    {
        return $this->tableNode;
    }

    /**
     * @return string
     */
    public function getTableVersion()
    {
        return $this->tableVersion;
    }
}
