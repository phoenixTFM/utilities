<?php


namespace utilities\SimpleTable;

/**
 * Interface ISimpleTableCell
 * @package utilities\SimpleTables
 */
interface ISimpleTableCell
{
    /**
     * Converts the cell setup to an HTML-String.
     * @return string
     */
    public function __toString(): string;

    /**
     * Get the colspan.
     * @return int
     */
    public function getColSpan(): int;

    /**
     * Get the rowspan.
     * @return int
     */
    public function getRowSpan(): int;

    /**
     * Sets the colspan.
     * @param int $span
     * @return $this
     */
    public function setColSpan(int $span): self;

    /**
     * Sets the rowspan.
     * @param int $span
     * @return $this
     */
    public function setRowSpan(int $span): self;

    /**
     * Add content.
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): self;
}