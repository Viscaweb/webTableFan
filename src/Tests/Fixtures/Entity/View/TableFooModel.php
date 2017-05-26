<?php

namespace Visca\WebTableFan\Tests\Fixtures\Entity\View;

use Visca\WebTableFan\Entity\View\TableModelInterface;

/**
 * Class TableFooModel.
 */
class TableFooModel implements TableModelInterface
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return 'table-foo';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'table-name';
    }

    /**
     * Gets list of CSS classes to apply to table.
     *
     * @return string[]
     */
    public function getCssClasses(): array
    {
        return [];
    }

    /**
     * Gets colgroups.
     *
     * @return string[]
     */
    public function getColGroups(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function getMarkupId()
    {
        return $this->getId();
    }
}
