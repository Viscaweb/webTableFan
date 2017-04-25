<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\View;

/**
 * Class CellModelInterface.
 */
interface CellModelInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @deprecated Use getId()
     *
     * @return string
     */
    public function getCellId(): string;

    /**
     * @return int
     */
    public function getCellColspan(): int;

    /**
     * Sets number of columns this cell will span to.
     *
     * @param int $cellColspan Number of columns.
     *
     * @return $this
     */
    public function setCellColspan(int $cellColspan);

    /**
     * Returns number of rows this cell will span to.
     *
     * @return int
     */
    public function getCellRowspan(): int;

    /**
     * Set number of rows this cell will span to.
     *
     * @param int $cellRowspan
     *
     * @return $this
     */
    public function setCellRowspan(int $cellRowspan);

    /**
     * Returns cell type.
     *
     * @return string CellTypes::TD | CellTypes::TH
     */
    public function getCellType(): string;

    /**
     * @param string $cellType self::TH|self::TD
     *
     * @return $this
     */
    public function setCellType(string $cellType);

    /**
     * @return array
     */
    public function getHtmlClass();
}
