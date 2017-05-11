<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\View;

/**
 * Interface InterfaceRowModel.
 */
interface RowModelInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string[]
     */
    public function getCssClasses(): array;

    /**
     * @return bool
     */
    public function isMobile(): bool;

    /**
     * @param bool $isMobile
     *
     * @return $this
     */
    public function setMobile(bool $isMobile);
}
