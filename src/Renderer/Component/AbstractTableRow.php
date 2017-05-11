<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\Node\Node;
use Visca\WebTableFan\Entity\Node\RowNode;

/**
 * Class AbstractTableRow.
 */
abstract class AbstractTableRow implements RowRendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function getIdentifier($rowModel): string
    {
        return 'row_'.uniqid(str_replace('\\', '-', get_class($rowModel)), true);
    }

    /**
     * {@inheritdoc}
     */
    public function getNode($rowModel): Node
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
    public function getAttributes($rowModel): array
    {
        return [];
    }
}
