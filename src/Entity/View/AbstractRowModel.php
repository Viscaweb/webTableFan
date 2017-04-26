<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\View;

/**
 * Class AbstractRowModel.
 */
abstract class AbstractRowModel implements RowModelInterface
{
    /** @var string[] */
    protected $cssClasses;

    /** @var bool */
    protected $mobile;

    /**
     * AbstractRowModel constructor.
     */
    public function __construct()
    {
        $this->cssClasses = [];
        $this->mobile = false;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return '';
    }

    /**
     * @deprecated Use `getId()` instead.
     *
     * @return string
     */
    public function getRowId(): string
    {
        return $this->getId();
    }

    /**
     * Gets list of CSS classes to apply to table.
     *
     * @return \string[]
     */
    public function getCssClasses(): array
    {
        return $this->cssClasses;
    }

    /**
     * Sets the CSS classes to apply to the table as attribute.
     *
     * @param string[] $cssClasses List of css classes to apply.
     *
     * @return $this
     */
    public function setCssClasses(array $cssClasses = [])
    {
        $this->cssClasses = $cssClasses;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isMobile(): bool
    {
        return $this->mobile;
    }

    /**
     * {@inheritdoc}
     */
    public function setMobile(bool $isMobile)
    {
        $this->mobile = $isMobile;

        return $this;
    }
}
