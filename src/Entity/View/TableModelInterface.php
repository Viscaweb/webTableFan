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
     * @todo Stop using this and use getId()
     *
     * @deprecated use getId()
     *
     * @return string
     */
    public function getName();

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

    /**
     * @todo Merge with getId()
     *
     * @deprecated Use getId()
     *
     * @return string
     */
    public function getMarkupId();
}
