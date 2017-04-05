<?php

namespace Visca\WebTableFan\Tests\Fixtures\Entity\View;

use Visca\WebTableFan\Entity\Code\CellTypes;
use Visca\WebTableFan\Entity\View\CellModelInterface;

/**
 * Class CellFooModel
 */
class CellFooModel implements CellModelInterface
{
    public function getId()
    {
        return 'cell-tag';
    }

    /**
     * @return string
     */
    public function getCellId()
    {
        return $this->getId();
    }

    /**
     * @return int
     */
    public function getCellColspan()
    {
        return null;
    }

    /**
     * Sets number of columns this cell will span to.
     *
     * @param int $cellColspan Number of columns.
     *
     * @return $this
     */
    public function setCellColspan($cellColspan)
    {
        // TODO: Implement setCellColspan() method.
    }

    /**
     * Returns number of rows this cell will span to.
     *
     * @return int
     */
    public function getCellRowspan()
    {
        return null;
    }

    /**
     * Set number of rows this cell will span to.
     *
     * @param int $cellRowspan
     *
     * @return $this
     */
    public function setCellRowspan($cellRowspan)
    {
        // TODO: Implement setCellRowspan() method.
    }

    /**
     * Returns cell type.
     *
     * @return CellTypes::TD | CellTypes::TH
     */
    public function getCellType()
    {
        return CellTypes::TD;
    }

    /**
     * @param string $cellType self::TH|self::TD
     *
     * @return $this
     */
    public function setCellType($cellType)
    {
        // TODO: Implement setCellType() method.
    }
}
