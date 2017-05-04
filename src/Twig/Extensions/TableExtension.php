<?php

namespace Visca\WebTableFan\Twig\Extensions;

use Twig_Environment;
use Twig_Extension;

/**
 * Class TableExtension.
 */
class TableExtension extends Twig_Extension
{
    /** @var string */
    protected $keyPrefix = 'data-';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'visca_table_extension';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'table_attributes',
                [$this, 'renderHtmlAttributes'],
                ['is_safe' => ['html'], 'needs_environment' => true]
            ),
        ];
    }

    /**
     * @param Twig_Environment $twig
     * @param array            $panelAttributes
     *
     * @return string
     */
    public function renderHtmlAttributes(\Twig_Environment $twig, $panelAttributes)
    {
        /*
         * First of all, the keys has to be formatted.
         * We'll here avoid the duplication in case there are some
         */
        $panelAttributesFormatted = [];
        foreach ($panelAttributes as $key => $value) {
            $formattedKey = $this->formatKey($key, false);
            $panelAttributesFormatted[$formattedKey] = $value;
        }

        $htmlAttributes = '';
        foreach ($panelAttributesFormatted as $formattedKey => $value) {
            if (is_array($value)) {
                $value = implode(' ', $value);
            }

            $valueEscaped = twig_escape_filter($twig, $value);
            $htmlAttributes .= ' '.$formattedKey.'="'.$valueEscaped.'"'."\n";
        }

        return $htmlAttributes;
    }

    /**
     * @param string $key          Key
     * @param bool   $injectPrefix Inject the prefix
     *
     * @return string
     */
    private function formatKey($key, $injectPrefix)
    {
        /*
         * Replace "myCustomValue" by "my-custom-value"
         */
        $key = preg_replace_callback(
            '/[A-Z]/',
            [$this, 'transformUppercaseInKey'],
            $key
        );

        /*
         * Removed all the unallowed values
         */
        $key = preg_replace('/[^a-z0-9-]/', '-', $key);

        /*
         * Remove the doubles dashes, dashes at the beginning and at the end
         */
        $key = preg_replace('/[-]{2,}/', '-', $key);
        $key = preg_replace('/^-/', '', $key);
        $key = preg_replace('/-$/', '', $key);

        /*
         * Adds the prefix
         */
        if ($injectPrefix) {
            $key = $this->keyPrefix.$key;
        }

        return trim($key);
    }

    /**
     * @param $arguments
     *
     * @return string
     */
    private function transformUppercaseInKey($arguments)
    {
        return '-'.strtolower($arguments[0]);
    }
}
