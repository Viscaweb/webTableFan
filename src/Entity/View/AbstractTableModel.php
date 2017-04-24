<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\View;

/**
 * Class AbstractTableModel.
 */
abstract class AbstractTableModel implements TableModelInterface
{
    /** @var string[] */
    protected $cssClasses;

    /** @var string[] */
    protected $colGroups;

    /** @var string */
    protected $refreshUrl;

    /** @var bool */
    protected $mobile;

    /** @var string */
    private $id;

    /**
     * @param string $id
     * @param string $variantId
     */
    public function __construct(string $id, string $variantId = 'default')
    {
        $this->id = 'table-'.$id.'-'.$variantId;
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRefreshUrl(): string
    {
        return $this->refreshUrl;
    }

    /**
     * @param string $refreshUrl
     *
     * @return $this
     */
    public function setRefreshUrl(string $refreshUrl)
    {
        $this->refreshUrl = $refreshUrl;

        return $this;
    }

    /**
     * Gets list of CSS classes to apply to table.
     *
     * @return \string[]
     */
    public function getCssClasses(): array
    {
        return $this->cssClasses;
    }

    /**
     * Sets the CSS classes to apply to the table as attribute.
     *
     * @param string[] $cssClasses List of css classes to apply.
     *
     * @return $this
     */
    public function setCssClasses(array $cssClasses = [])
    {
        $this->cssClasses = $cssClasses;

        return $this;
    }

    /**
     * Adds a single CSS class to the table.
     *
     * @param string $cssClass A CSS class.
     *
     * @return $this
     */
    public function addCssClass($cssClass)
    {
        $this->cssClasses[] = $cssClass;

        return $this;
    }

    /**
     * Gets colgroups.
     *
     * @return \string[]
     */
    public function getColGroups(): array
    {
        return $this->colGroups;
    }

    /**
     * Sets the colgroups to add to the table.
     * To specify them, just pass an array with a list of CSS classes to apply
     * to each desired colgroup.
     *
     * @param string[] $colGroups List of groups.
     *
     * @return $this
     */
    public function setColGroups(array $colGroups = [])
    {
        $this->colGroups = $colGroups;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMobile()
    {
        return $this->mobile;
    }

    /**
     * @param bool $mobile
     *
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }
}
