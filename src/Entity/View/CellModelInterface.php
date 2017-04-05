<?php

namespace Visca\WebTableFan\Entity\View;

use Visca\WebTableFan\Entity\Code\CellTypes;

/**
 * Class CellModelInterface.
 */
interface CellModelInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @deprecated Use getId()
     * @return string
     */
    public function getCellId();

    /**
     * @return int
     */
    public function getCellColspan();

    /**
     * Sets number of columns this cell will span to.
     *
     * @param int $cellColspan Number of columns.
     *
     * @return $this
     */
    public function setCellColspan($cellColspan);

    /**
     * Returns number of rows this cell will span to.
     *
     * @return int
     */
    public function getCellRowspan();

    /**
     * Set number of rows this cell will span to.
     *
     * @param int $cellRowspan
     *
     * @return $this
     */
    public function setCellRowspan($cellRowspan);

    /**
     * Returns cell type.
     *
     * @return CellTypes::TD | CellTypes::TH
     */
    public function getCellType();

    /**
     * @param string $cellType self::TH|self::TD
     *
     * @return $this
     */
    public function setCellType($cellType);
}
