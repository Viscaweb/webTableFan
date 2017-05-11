<?php

namespace Visca\WebTableFan\Tests\Fixtures\Renderers;

use Visca\WebTableFan\Renderer\Component\TableRendererInterface;
use Visca\WebTableFan\Tests\Fixtures\Entity\Node\TableFooNode;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\BodyFooModel;

/**
 * Class TableFooRenderer.
 */
class TableFooRenderer implements TableRendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function getNode($model)
    {
        return new TableFooNode($model->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier($tableModel)
    {
        return $tableModel->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getBodies($tableModel)
    {
        return [new BodyFooModel()];
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes($tableModel)
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getColGroups($tableModel)
    {
        return $tableModel->getColGroups();
    }
}
