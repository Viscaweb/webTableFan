<?php

namespace Visca\WebTableFan\Diff\Entity;

use Visca\WebTableFan\Entity\Node\Node;

class NodeDifferences
{
    /** @var string */
    protected $beforeTableId;

    /** @var string */
    protected $afterTableId;

    /** @var NodeUpdated[] */
    protected $updated;

    /** @var NodeAdded[] */
    protected $added;

    /** @var NodeDeleted[] */
    protected $deleted;

    /**
     * NodeDifferences constructor.
     *
     * @param string        $tableAId
     * @param string        $tableBId
     * @param NodeAdded[]   $updated
     * @param NodeUpdated[] $added
     * @param NodeDeleted[] $deleted
     */
    public function __construct($tableAId, $tableBId, array $updated = [], array $added = [], array $deleted = [])
    {
        $this->beforeTableId = $tableAId;
        $this->afterTableId = $tableBId;
        $this->updated = $updated;
        $this->added = $added;
        $this->deleted = $deleted;
    }

    /**
     * @return NodeUpdated[]
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @return NodeAdded[]
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * @return NodeDeleted[]
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @return string
     */
    public function getAfterTableId()
    {
        return $this->afterTableId;
    }
}
