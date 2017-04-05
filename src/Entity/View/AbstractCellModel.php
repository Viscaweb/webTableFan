<?php

namespace Visca\WebTableFan\Entity\View;

use Visca\WebTableFan\Entity\Code\CellTypes;

/**
 * Class AbstractCellModel.
 */
abstract class AbstractCellModel implements CellModelInterface
{
    /** @var string */
    protected $cellId;

    /** @var int */
    protected $cellColspan;

    /** @var int */
    protected $cellRowspan;

    /** @var string */
    protected $cellType;

    /** @var string */
    protected $htmlClass;

    /** @var bool */
    protected $mobile = false;

    /** @var bool */
    protected $strongCell = false;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->cellColspan = 1;
        $this->cellRowspan = 1;
        $this->cellType = CellTypes::TD;
    }

    /**
     * @return bool
     */
    public function isStrongCell()
    {
        return $this->strongCell;
    }

    /**
     * @param bool $strongCell
     *
     * @return $this
     */
    public function setStrongCell($strongCell)
    {
        $this->strongCell = $strongCell;

        return $this;
    }

    /**
     * @return string
     */
    public function getCellId()
    {
        return $this->cellId;
    }

    /**
     * @param string $cellId
     *
     * @return $this
     */
    public function setCellId($cellId)
    {
        $this->cellId = $cellId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCellColspan()
    {
        return $this->cellColspan;
    }

    /**
     * {@inheritdoc}
     */
    public function setCellColspan($cellColspan)
    {
        $this->cellColspan = $cellColspan;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCellRowspan()
    {
        return $this->cellRowspan;
    }

    /**
     * @param int $cellRowspan
     *
     * @return $this
     */
    public function setCellRowspan($cellRowspan)
    {
        $this->cellRowspan = $cellRowspan;

        return $this;
    }

    /**
     * Returns cell type.
     *
     * @return string
     */
    public function getCellType()
    {
        return $this->cellType;
    }

    /**
     * @param string $cellType self::TH|self::TD
     *
     * @return $this
     */
    public function setCellType($cellType)
    {
        $this->cellType = $cellType;

        return $this;
    }

    /**
     * @return string|string[]
     */
    public function getHtmlClass()
    {
        return $this->htmlClass;
    }

    /**
     * @param string $htmlClass Html Class of the cell
     *
     * @return $this
     */
    public function setHtmlClass($htmlClass)
    {
        $this->htmlClass = $htmlClass;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMobile()
    {
        return $this->mobile;
    }

    /**
     * @param bool $mobile
     *
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * @return int
     *
     * @todo Check if we really need this method or getCellId()
     */
    public function getId()
    {
        return $this->cellId;
    }

    /**
     * @param int $cellId
     *
     * @todo Check if we really need this method or setCellId()
     *
     * @return AbstractCellModel
     */
    public function setId($cellId)
    {
        $this->cellId = $cellId;

        return $this;
    }
}
