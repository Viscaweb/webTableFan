<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\View;

use Visca\WebTableFan\Entity\Code\CellTypes;

/**
 * Class AbstractCellModel.
 */
abstract class AbstractCellModel implements CellModelInterface
{
    /** @var string */
    protected $cellId;

    /** @var string */
    protected $id;

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
    public function isStrongCell(): bool
    {
        return $this->strongCell;
    }

    /**
     * @param bool $strongCell
     *
     * @return $this
     */
    public function setStrongCell(bool $strongCell)
    {
        $this->strongCell = $strongCell;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCellId(): string
    {
        return $this->id;
    }

    /**
     * @param string $cellId
     *
     * @return $this
     */
    public function setCellId(string $cellId)
    {
        $this->id = $cellId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCellColspan(): int
    {
        return $this->cellColspan;
    }

    /**
     * {@inheritdoc}
     */
    public function setCellColspan(int $cellColspan): self
    {
        $this->cellColspan = $cellColspan;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCellRowspan(): int
    {
        return $this->cellRowspan;
    }

    /**
     * {@inheritdoc}
     */
    public function setCellRowspan(int $cellRowspan): self
    {
        $this->cellRowspan = $cellRowspan;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCellType(): string
    {
        return $this->cellType;
    }

    /**
     * {@inheritdoc}
     */
    public function setCellType(string $cellType): self
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
    public function setHtmlClass(string $htmlClass)
    {
        $this->htmlClass = $htmlClass;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMobile(): bool
    {
        return $this->mobile;
    }

    /**
     * @param bool $mobile
     *
     * @return $this
     */
    public function setMobile(bool $mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }
}
