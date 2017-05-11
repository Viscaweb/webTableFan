<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\View;

/**
 * Interface BodyModelInterface.
 */
interface BodyModelInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getBodyType(): string;

    /**
     * @param $bodyType
     *
     * @return $this
     */
    public function setBodyType(string $bodyType);

    /**
     * @return string[]
     */
    public function getCssClasses(): array;

    /**
     * @param string[] $cssClasses
     *
     * @return $this
     */
    public function setCssClasses($cssClasses);

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
