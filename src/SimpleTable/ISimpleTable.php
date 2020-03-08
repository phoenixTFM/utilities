<?php


namespace utilities\SimpleTable;

/**
 * Interface ISimpleTable
 * @package utilities\SimpleTables
 */
interface ISimpleTable
{
    /**
     * Converts the table setup to an HTML-String.
     * @return string
     */
    public function __toString(): string;

    /**
     * Get the row at the index.
     * @param int $index
     * @return ISimpleTableRow
     */
    public function getRow(int $index): ISimpleTableRow;

    /**
     * Adds an row to the table
     * @param ISimpleTableRow $row
     * @return $this
     */
    public function addRow(ISimpleTableRow $row): self;
}