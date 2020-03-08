<?php


namespace utilities\SimpleTable;

use Iterator;

define('SIMPLE_TABLE_ROW_TYPE_BODY', 'tbody');
define('SIMPLE_TABLE_ROW_TYPE_HEAD', 'thead');
define('SIMPLE_TABLE_ROW_TYPE_FOOT', 'tfoot');

/**
 * Interface ISimpleTableRow
 * @package utilities\SimpleTables
 */
interface ISimpleTableRow extends Iterator
{
    /**
     * Converts the row setup to an HTML-String.
     * @return string
     */
    public function __toString(): string;

    /**
     * Builds a cell and adds it to the row.
     * @param string $content
     * @param string $style
     * @param int $colSpan
     * @param int $rowSpan
     * @return $this
     */
    public function buildCell(string $content, string $style = '', int $colSpan = 1, int $rowSpan = 1): self;

    /**
     * Adds a cell to the row.
     * @param ISimpleTableCell $cell The cell to add.
     * @return $this
     */
    public function addCell(ISimpleTableCell $cell): self;

    /**
     * Get the cell at the index.
     * @param int $index
     * @return ISimpleTableCell
     */
    public function getCell(int $index): ISimpleTableCell;

    /**
     * Return all cells of the row.
     * @return ISimpleTableCell[]
     */
    public function getCells(): array;

    /**
     * Get the number of cells in the row.
     * @return int
     */
    public function getCellAmount(): int;

    /**
     * Defines the row-tag.
     * Possible types: TABLE_ROW_TYPE_BODY, TABLE_ROW_TYPE_HEAD, TABLE_ROW_TYPE_FOOT
     * @param string $tag
     * @return $this
     */
    public function setRowTag(string $tag): self;

    /**
     * Get the row-html-tag.
     * Possible types: TABLE_ROW_TYPE_BODY, TABLE_ROW_TYPE_HEAD, TABLE_ROW_TYPE_FOOT
     *
     * @return string
     */
    public function getRowTag(): string;
}