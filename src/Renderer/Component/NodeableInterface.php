<?php

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\Node\Node;

/**
 * Interface NodeableInterface.
 */
interface NodeableInterface
{
    /**
     * @param mixed $model A model
     *
     * @return Node
     */
    public function getNode($model);
}
