<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Model;

use Visca\WebTableFan\Entity\Node\Node;

/**
 * Class TableRenderedModel
 */
class TableRenderedModel
{
    /** @var string */
    private $html;

    /** @var Node|null */
    private $tableNode;

    /**
     * TableRenderedModel constructor.
     *
     * @param string    $html
     * @param Node|null $tableNode
     */
    public function __construct(string $html, Node $tableNode = null)
    {
        $this->tableNode = $tableNode;
        $this->html = $html;
    }

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @return Node
     */
    public function getTableNode(): Node
    {
        return $this->tableNode;
    }
}
