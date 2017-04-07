<?php

namespace Visca\WebTableFan\Events;

use Composer\EventDispatcher\Event;

/**
 * Class TableRenderedEvent
 */
class TableRenderedEvent extends Event
{
    /** @var string @deprecated */
    private $tableName;

    /** @var string */
    private $tableId;

    /** @var string */
    private $tableRendered;

    /** @var string */
    private $tableVersion;

    /**
     * TableRenderedEvent constructor.
     *
     * @param string $tableName
     * @param string $tableId
     * @param string $tableVersion
     * @param string $tableRendered
     */
    public function __construct($tableName, $tableId, $tableVersion, $tableRendered)
    {
        parent::__construct(Events::TABLE_RENDERED);
        $this->tableName = $tableName;
        $this->tableId = $tableId;
        $this->tableVersion = $tableVersion;
        $this->tableRendered = $tableRendered;
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
     * @return string
     */
    public function getTableRendered()
    {
        return $this->tableRendered;
    }

    /**
     * @return string
     */
    public function getTableVersion()
    {
        return $this->tableVersion;
    }
}
