<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\View;

/**
 * Class TableModelInterface.
 */
interface TableModelInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * Gets list of CSS classes to apply to table.
     *
     * @return string[]
     */
    public function getCssClasses(): array;

    /**
     * Gets colgroups.
     *
     * @return string[]
     */
    public function getColGroups(): array;
}
