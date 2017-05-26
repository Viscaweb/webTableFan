<?php

namespace Visca\WebTableFan\Tests\Fixtures\Renderers;

use Visca\WebTableFan\Renderer\Component\RowRendererInterface;
use Visca\WebTableFan\Tests\Fixtures\Entity\Node\RowFooNode;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\CellFooModel;

/**
 * Class RowFooRenderer.
 */
class RowFooRenderer implements RowRendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function getNode($model)
    {
        return new RowFooNode($model->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier($rowModel): string
    {
        return $rowModel->getRowId();
    }

    /**
     * {@inheritdoc}
     */
    public function getCells($rowModel): array
    {
        return [new CellFooModel(), new CellFooModel()];
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes($rowModel): array
    {
        return [];
    }
}
