<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Model;

use Visca\WebTableFan\Entity\Node\TableNode;

/**
 * Class TableRenderedModel.
 */
class TableRenderedModel
{
    /** @var string */
    private $html;

    /** @var TableNode|null */
    private $tableNode;

    /**
     * TableRenderedModel constructor.
     *
     * @param string         $html
     * @param TableNode|null $tableNode
     */
    public function __construct(string $html, TableNode $tableNode = null)
    {
        $this->tableNode = $tableNode;
        $this->html = $html;
    }

    public function getHtml(): string
    {
        return $this->html;
    }

    public function getTableNode(): TableNode
    {
        return $this->tableNode;
    }
}
