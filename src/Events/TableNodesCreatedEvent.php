<?php

namespace Visca\WebTableFan\Events;

use Symfony\Component\EventDispatcher\Event;
use Visca\WebTableFan\Entity\Node\Node;

/**
 * Class TableNodesCreatedEvent.
 */
class TableNodesCreatedEvent extends Event
{
    /** @var string deprecated */
    private $tableName;

    /** @var string */
    private $tableId;

    /** @var Node */
    private $tableNode;

    /** @var string */
    private $tableVersion;

    /**
     * TableNodesCreatedEvent constructor.
     *
     * @param string $tableName
     * @param string $tableId
     * @param string $tableVersion
     * @param Node   $tableNode
     */
    public function __construct($tableName, $tableId, $tableVersion, Node $tableNode)
    {
        $this->tableName = $tableName;
        $this->tableId = $tableId;
        $this->tableVersion = $tableVersion;
        $this->tableNode = $tableNode;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @return string
     */
    public function getTableId()
    {
        return $this->tableId;
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
