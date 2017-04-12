<?php

namespace Visca\WebTableFan\Entity\View;

/**
 * Class TableModelInterface.
 */
interface TableModelInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * Gets list of CSS classes to apply to table.
     *
     * @return string[]
     */
    public function getCssClasses();

    /**
     * Gets colgroups.
     *
     * @return string[]
     */
    public function getColGroups();
}
