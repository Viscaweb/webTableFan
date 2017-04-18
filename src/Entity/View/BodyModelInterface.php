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
     * @return string
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

    /**
     * @return bool
     */
    public function isMobile();

    /**
     * @param bool $isMobile
     *
     * @return $this
     */
    public function setMobile($isMobile);
}
