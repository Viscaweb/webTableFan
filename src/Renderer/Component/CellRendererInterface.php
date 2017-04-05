<?php

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\View\CellModelInterface;

/**
 * CellRendererInterface.
 */
interface CellRendererInterface extends NodeableInterface
{
    /**
     * @param CellModelInterface $cellModel Model
     *
     * @return string
     */
    public function getIdentifier($cellModel);

    /**
     * @param CellModelInterface $cellModel Model
     *
     * @return string
     */
    public function getCellType($cellModel);

    /**
     * @param mixed $cellNode Node
     *
     * @throws \Exception
     *
     * @return string
     */
    public function getContent($cellNode);

    /**
     * @param CellModelInterface $cellModel Model
     *
     * @return mixed
     */
    public function getAttributes($cellModel);
}
