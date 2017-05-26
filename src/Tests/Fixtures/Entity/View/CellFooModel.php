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
    public function getId(): string
    {
        return 'cell-tag';
    }

    /**
     * {@inheritdoc}
     */
    public function getCellId(): string
    {
        return $this->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getCellColspan(): int
    {
    }

    /**
     * {@inheritdoc}
     */
    public function setCellColspan(int $cellColspan = null)
    {
        // TODO: Implement setCellColspan() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getCellRowspan(): int
    {
    }

    /**
     * {@inheritdoc}
     */
    public function setCellRowspan(int $cellRowspan = null)
    {
        // TODO: Implement setCellRowspan() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getCellType(): string
    {
        return CellTypes::TD;
    }

    /**
     * {@inheritdoc}
     */
    public function setCellType(string $cellType)
    {
        // TODO: Implement setCellType() method.
    }

    /**
     * @return array
     */
    public function getHtmlClass()
    {
        return [];
    }
}
