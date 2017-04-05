<?php

namespace Visca\WebTableFan\Entity\View;

/**
 * Class AbstractRowModel.
 */
abstract class AbstractRowModel implements RowModelInterface
{
    /** @var string[] */
    protected $cssClasses;

    /**
     * @return string
     */
    public function getRowId()
    {
        return '';
    }

    /**
     * Gets list of CSS classes to apply to table.
     *
     * @return \string[]
     */
    public function getCssClasses()
    {
        return $this->cssClasses;
    }
}