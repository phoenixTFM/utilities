<?php


namespace utilities\SimpleTable;


/**
 * Class SimpleTableAbstract
 * @package utilities\SimpleTables
 */
class SimpleTableTemplate implements ISimpleTable
{
    use TSimpleTableStyle;

    /** @var SimpleTableRow[] */
    private array $rows = [];

    /**
     * @inheritDoc
     * @throws SimpleTableException
     */
    public function getRow(int $index): ISimpleTableRow
    {
        if (!isset($this->rows[$index]))
        {
            throw new SimpleTableException('No row at index "' . $index . '".');
        }

        return $this->rows[$index];
    }

    /**
     * @inheritDoc
     */
    public function addRow(ISimpleTableRow $row): ISimpleTable
    {
        $this->rows[] = $row;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $html = "<table{$this->getStyleClassNameAsHtml()}>";

        $prevRowTag = '';

        /** @var SimpleTableRow $row */
        foreach ($this->rows as $row)
        {
            if ($prevRowTag === '' || $prevRowTag !== $row->getRowTag())
            {
                // it's not the first tag ever and it's different then the prev. tag -> close it.
                if ($prevRowTag !== '' && $prevRowTag !== $row->getRowTag())
                {
                    $html .= "</$prevRowTag>";
                }

                $prevRowTag = $row->getRowTag();
                $html .= "<$prevRowTag{$row->getStyleClassNameAsHtml()}>";
            }

            // add cells from current row.
            $html .= (string) $row;
        }

        // add last closing tag.
        $html .= "</$prevRowTag>";

        $html .= '</table>';


        return $html;
    }
}