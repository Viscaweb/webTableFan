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
     * @return string[]
     */
    public function getCssClasses();

    /**
     * @return bool
     */
    public function isMobile();

    /**
     * @param bool $isMobile
     *
     * @return $this
     */
    public function setMobile($isMobile);
}
