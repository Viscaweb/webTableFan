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
    public function getIdentifier($cellModel)
    {
        return $cellModel->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getCellType($cellModel)
    {
        // TODO: Implement getCellType() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getContent($cellNode)
    {
        // TODO: Implement getContent() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes($cellModel)
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
