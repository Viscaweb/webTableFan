<?php

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
     * @return string
     */
    public function getId()
    {
        return '';
    }

    /**
     * @deprecated Use `getId()` instead.
     *
     * @return string
     */
    public function getRowId()
    {
        return $this->getId();
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


    /**
     * {@inheritdoc}
     */
    public function isMobile()
    {
        return $this->mobile;
    }

    /**
     * {@inheritdoc}
     */
    public function setMobile($isMobile)
    {
        $this->mobile = $isMobile;

        return $this;
    }
}
