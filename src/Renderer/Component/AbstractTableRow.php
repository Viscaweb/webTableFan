<?php

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\Node\RowNode;

/**
 * Class AbstractTableRow.
 */
abstract class AbstractTableRow implements RowRendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function getIdentifier($rowModel)
    {
        return 'row_'.uniqid(str_replace('\\', '-', get_class($rowModel)), true);
    }

    /**
     * {@inheritdoc}
     */
    public function getNode($rowModel)
    {
        $node = new RowNode(
            $this->getIdentifier($rowModel),
            $this->getAttributes($rowModel)
        );

        return $node;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes($rowModel)
    {
        return [];
    }
}
