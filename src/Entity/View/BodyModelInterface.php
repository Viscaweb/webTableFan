<?php

namespace Visca\WebTableFan\Entity\View;

/**
 * Interface BodyModelInterface.
 */
interface BodyModelInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return
     */
    public function getBodyType();

    /**
     * @param $bodyType
     *
     * @return mixed
     */
    public function setBodyType($bodyType);

    /**
     * @return string[]
     */
    public function getCssClasses();

    /**
     * @param string[] $cssClasses
     *
     * @return $this
     */
    public function setCssClasses($cssClasses);
}
