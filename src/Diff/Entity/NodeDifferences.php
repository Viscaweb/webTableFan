<?php

namespace Visca\WebTableFan\Diff\Entity;

use Visca\WebTableFan\Entity\Node\Node;

class NodeDifferences
{
    /** @var string */
    protected $tableAIdentifier;

    /** @var string */
    protected $tableBIdentifier;

    /** @var Node[] */
    protected $updated;

    /** @var Node[] */
    protected $added;

    /** @var Node[] */
    protected $deleted;

    /**
     * NodeDifferences constructor.
     *
     * @param Node $tableA
     * @param Node $tableB
     * @param Node[] $updated
     * @param Node[] $added
     * @param Node[] $deleted
     */
    public function __construct(Node $tableA, Node $tableB, array $updated = [], array $added = [], array $deleted = [])
    {
        $this->tableAIdentifier = $this->getTableIdentifier($tableA);
        $this->tableBIdentifier = $this->getTableIdentifier($tableB);
        $this->updated = $updated;
        $this->added = $added;
        $this->deleted = $deleted;
    }

    /**
     * @param Node $table
     *
     * @return string
     */
    private function getTableIdentifier(Node $table)
    {
        return $table->getId().':'.$table->getVersion();
    }

    /**
     * @return Node[]
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @return Node[]
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * @return Node[]
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}
