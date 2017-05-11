<?php

namespace Visca\WebTableFan\Tests\Fixtures\Entity\View;

use Visca\WebTableFan\Entity\Code\CellTypes;
use Visca\WebTableFan\Entity\View\CellModelInterface;

/**
 * Class CellFooModel.
 */
class CellFooModel implements CellModelInterface
{
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return 'cell-tag';
    }

    /**
     * {@inheritdoc}
     */
    public function getCellId()
    {
        return $this->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getCellColspan()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function setCellColspan($cellColspan)
    {
        // TODO: Implement setCellColspan() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getCellRowspan()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function setCellRowspan($cellRowspan)
    {
        // TODO: Implement setCellRowspan() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getCellType()
    {
        return CellTypes::TD;
    }

    /**
     * {@inheritdoc}
     */
    public function setCellType($cellType)
    {
        // TODO: Implement setCellType() method.
    }
}
