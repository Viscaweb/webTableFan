<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\Node\BodyNode;
use Visca\WebTableFan\Entity\Node\Node;
use Visca\WebTableFan\Entity\View\BodyModelInterface;

/**
 * Class AbstractBody.
 */
abstract class AbstractTableBody implements BodyRendererInterface
{
    /**
     * {@inheritdoc}
     */
    final public function getIdentifier($model): string
    {
        return $model->getId();
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
    public function getNode($bodyModel): Node
    {
        $node = new BodyNode(
            $this->getIdentifier($bodyModel),
            $this->getAttributes($bodyModel)
        );
        $node->setType($bodyModel->getBodyType());

        return $node;
    }
}
