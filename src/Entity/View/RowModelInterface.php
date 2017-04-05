<?php

namespace Visca\WebTableFan\Entity\View;

/**
 * Interface InterfaceRowModel.
 */
interface RowModelInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     *
     * @deprecated
     */
    public function getRowId();

    /**
     * @return string[]
     */
    public function getCssClasses();
}
