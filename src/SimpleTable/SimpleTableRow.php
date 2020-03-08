<?php


namespace utilities\SimpleTable;

use Exception;

/**
 * Class SimpleTableRow
 * @package utilities\SimpleTables
 */
class SimpleTableRow implements ISimpleTableRow
{
    use TSimpleTableStyle;

    private string $rowTag = SIMPLE_TABLE_ROW_TYPE_BODY;
    private int $position = 0;
    /** @var SimpleTableCell[] */
    private array $cells = [];

    /**
     * SimpleTableRow constructor.
     * @param string $rowTag
     */
    public function __construct(string $rowTag = SIMPLE_TABLE_ROW_TYPE_BODY)
    {
        $this->position = 0;
        $this->rowTag = $rowTag;
        $this->setStyleClassName('');
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $html = "<tr>";

        foreach ($this->getCells() as $cell)
        {
            $html .= $cell;
        }

        $html .= '</tr>';

        return $html;
    }

    /**
     * @inheritDoc
     * @throws SimpleTableException
     */
    public function buildCell(string $content, string $style = '', int $colSpan = 1, int $rowSpan = 1): ISimpleTableRow
    {
        $this->cells[] = new SimpleTableCell($content, $style, $colSpan, $rowSpan);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addCell(ISimpleTableCell $cell): ISimpleTableRow
    {
        $this->cells[] = $cell;
        return $this;
    }

    /**
     * @inheritDoc
     * @throws SimpleTableException
     */
    public function getCell(int $index): ISimpleTableCell
    {
        if (!isset($this->cells[$index]))
        {
            throw new SimpleTableException('No row at index "' . $index . '".');
        }

        return $this->cells[$index];
    }

    /**
     * @inheritDoc
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    /**
     * @inheritDoc
     */
    public function getCellAmount(): int
    {
        return sizeof($this->cells);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function current(): ISimpleTableCell
    {
        return $this->getCell($this->position);
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        $this->position++;
    }

    /**
     * @inheritDoc
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return isset($this->cells[$this->position]);
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @inheritDoc
     * @throws SimpleTableException
     */
    public function setRowTag(string $tag): ISimpleTableRow
    {
        if ($tag !== SIMPLE_TABLE_ROW_TYPE_BODY && $tag !== SIMPLE_TABLE_ROW_TYPE_HEAD && $tag !== SIMPLE_TABLE_ROW_TYPE_FOOT)
        {
            throw new SimpleTableException('Invalid row-type "' . $tag . '"');
        }

        $this->rowTag = $tag;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRowTag(): string
    {
        return $this->rowTag;
    }
}