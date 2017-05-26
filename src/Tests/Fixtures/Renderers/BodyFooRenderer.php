<?php

namespace Visca\WebTableFan\Tests\Fixtures\Renderers;

use Visca\WebTableFan\Entity\View\BodyModelInterface;
use Visca\WebTableFan\Renderer\Component\BodyRendererInterface;
use Visca\WebTableFan\Tests\Fixtures\Entity\Node\BodyFooNode;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\RowFooModel;

/**
 * Class BodyFooRenderer.
 */
class BodyFooRenderer implements BodyRendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function getIdentifier($model): string
    {
        return $model->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getRows($body): array
    {
        return [new RowFooModel()];
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes($model): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getBodyType(BodyModelInterface $model): string
    {
        return $model->getBodyType();
    }

    /**
     * {@inheritdoc}
     */
    public function getNode($model)
    {
        return new BodyFooNode($model->getId());
    }
}
