<?php

namespace Visca\WebTableFan\Tests\Fixtures\Entity\View;

use Visca\WebTableFan\Entity\View\RowModelInterface;

/**
 * Class RowFooModel.
 */
class RowFooModel implements RowModelInterface
{
    public function getId()
    {
        return 'row-tag';
    }

    /**
     * @return string
     *
     * @deprecated
     */
    public function getRowId()
    {
        return $this->getId();
    }

    /**
     * @return string[]
     */
    public function getCssClasses()
    {
        return [];
    }
}
