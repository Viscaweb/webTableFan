<?php

namespace Visca\WebTableFan\Tests\Fixtures\Renderers;

use Visca\WebTableFan\Renderer\Component\CellRendererInterface;
use Visca\WebTableFan\Tests\Fixtures\Entity\Node\CellFooNode;

/**
 * Class CellFooRenderer.
 */
class CellFooRenderer implements CellRendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function getIdentifier($cellModel): string
    {
        return $cellModel->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getCellType($cellModel): string
    {
        // TODO: Implement getCellType() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getContent($cellNode): string
    {
        return 'CELL CONTENT';
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes($cellModel): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getNode($cellModel)
    {
        return new CellFooNode($cellModel->getId());
    }
}
