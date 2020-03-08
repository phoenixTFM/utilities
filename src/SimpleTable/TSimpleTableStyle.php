<?php


namespace utilities\SimpleTable;

/**
 * Trait TSimpleTableStyle
 * @package utilities\SimpleTable
 */
trait TSimpleTableStyle
{
    private string $styleClassName = '';

    /**
     * Set the style-class.
     * @param string $style
     * @return $this
     */
    public function setStyleClassName(string $style): self
    {
        $this->styleClassName = $style;
        return $this;
    }

    /**
     * Get the style-class-name.
     * @return string
     */
    public function getStyleClassName(): string
    {
        return $this->styleClassName;
    }

    /**
     * Get the HTML-String for CSS-Class.
     * If no style is set, an empty string is returned instead.
     * @return string
     */
    public function getStyleClassNameAsHtml(): string
    {
        $style = $this->getStyleClassName();
        return ($style === '') ? '' : " class='$style'";
    }

    /**
     * Removes the style-class-name.
     * @return $this
     */
    public function clearStyleClassName(): self
    {
        $this->styleClassName = '';
        return $this;
    }
}