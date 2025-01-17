<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\Code\HtmlAttributes;
use Visca\WebTableFan\Entity\Node\Node;
use Visca\WebTableFan\Entity\Node\TableNode;
use Visca\WebTableFan\Entity\View\AbstractTableModel;
use Visca\WebTableFan\Entity\View\TableModelInterface;

/**
 * Class AbstractTable.
 */
abstract class AbstractTable implements TableRendererInterface
{
    /**
     * {@inheritdoc}
     */
    final public function getIdentifier($tableModel): string
    {
        return $tableModel->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getNode($tableModel): Node
    {
        $attributes = $this->getAttributes($tableModel);

        /* @var TableModelInterface $tableModel */
        $node = new TableNode($this->getIdentifier($tableModel), $attributes);

        $node->setType('table');

        $colgroup = $tableModel->getColGroups();
        if (!empty($colgroup)) {
            $node->setColGroup($colgroup);
        }

        return $node;
    }

    /**
     * @param TableModelInterface $tableModel Model
     *
     * @return array
     */
    public function getAttributes($tableModel): array
    {
        $attributes = [
//            'data-name' => $tableModel->getName(), Use only for AJAX RealTime implementation
            HtmlAttributes::CSSCLASS => implode(' ', $tableModel->getCssClasses()),
        ];

        return $attributes;
    }

    /**
     * @param AbstractTableModel $tableModel
     *
     * @return string[]
     */
    public function getColGroups($tableModel): array
    {
        return $tableModel->getColGroups();
    }
}
