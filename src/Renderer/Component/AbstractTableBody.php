<?php

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\Node\BodyNode;
use Visca\WebTableFan\Entity\View\BodyModelInterface;

/**
 * Class AbstractBody.
 */
abstract class AbstractTableBody implements BodyRendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function getIdentifier($model)
    {
        return 'body_'.uniqid(str_replace('\\', '-', get_class($model)), true);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes($model)
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getBodyType(BodyModelInterface $model)
    {
        return $model->getBodyType();
    }

    /**
     * {@inheritdoc}
     */
    public function getNode($bodyModel)
    {
        $node = new BodyNode(
            $this->getIdentifier($bodyModel),
            $this->getAttributes($bodyModel)
        );
        $node->setType($bodyModel->getBodyType());

        return $node;
    }
}
