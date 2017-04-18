<?php

namespace Visca\WebTableFan\Entity\View;

use Visca\WebTableFan\Entity\Code\BodyTypes;

/**
 * Class AbstractBodyModel.
 */
abstract class AbstractBodyModel implements BodyModelInterface
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $bodyType;

    /** @var string[] */
    protected $cssClasses;

    /** @var bool */
    protected $mobile;

    /**
     * AbstractBodyModel constructor.
     *
     * @param string $id
     * @param string $bodyType
     */
    public function __construct($id, $bodyType = BodyTypes::TBODY)
    {
        $this->id = $id;
        $this->bodyType = $bodyType;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBodyType()
    {
        return $this->bodyType;
    }

    /**
     * {@inheritdoc}
     */
    public function setBodyType($bodyType)
    {
        $this->bodyType = $bodyType;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCssClasses()
    {
        return $this->cssClasses;
    }

    /**
     * {@inheritdoc}
     */
    public function setCssClasses($cssClasses)
    {
        $this->cssClasses = $cssClasses;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isMobile()
    {
        return $this->mobile;
    }

    /**
     * {@inheritdoc}
     */
    public function setMobile($isMobile)
    {
        $this->mobile = $isMobile;

        return $this;
    }
}
