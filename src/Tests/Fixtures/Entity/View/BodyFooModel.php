<?php

namespace Visca\WebTableFan\Tests\Fixtures\Entity\View;

use Visca\WebTableFan\Entity\Code\BodyTypes;
use Visca\WebTableFan\Entity\View\BodyModelInterface;

/**
 * Class BodyFooModel
 */
class BodyFooModel implements BodyModelInterface
{
    /** @var string */
    protected $bodyType;

    /**
     * @return string
     */
    public function getId()
    {
        return 'body-tag';
    }

    /**
     * @return
     */
    public function getBodyType()
    {
        return BodyTypes::TBODY;
    }

    /**
     * @param $bodyType
     *
     * @return mixed
     */
    public function setBodyType($bodyType)
    {
        $this->bodyType = $bodyType;
    }

    /**
     * @return string[]
     */
    public function getCssClasses()
    {
        return [];
    }

    /**
     * @param string[] $cssClasses
     *
     * @return $this
     */
    public function setCssClasses($cssClasses)
    {
    }
}
