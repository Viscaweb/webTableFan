<?php

namespace Visca\WebTableFan\Renderer\Component;

/**
 * TableCellInterface.
 */
interface TableCellInterface extends NodeableInterface
{
    /**
     * @param mixed $cell Model
     *
     * @return string
     */
    public function getIdentifier($cell);

    /**
     * @param mixed $cell Model
     *
     * @return string
     */
    public function getCellType($cell);

    /**
     * @param mixed $cell Node
     *
     * @throws \Exception
     *
     * @return string
     */
    public function getContent($cell);

    /**
     * @param mixed $cell Model
     *
     * @return mixed
     */
    public function getAttributes($cell);
}
