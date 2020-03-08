<?php


namespace Table\CLI;


use PHPUnit\Framework\TestCase;
use utilities\SimpleTable\SimpleTableException;
use utilities\SimpleTable\SimpleTableTemplate;
use utilities\SimpleTable\SimpleTableRow;
use utilities\SimpleTable\SimpleTableCell;

class testSimpleTable extends TestCase
{
    /**
     * @throws SimpleTableException
     */
    public function testGetDefaultStyleClassNames()
    {
        $cell = new SimpleTableCell();
        $this->assertEquals('', $cell->getStyleClassName());

        $bodyRow = new SimpleTableRow();
        $headRow = new SimpleTableRow(SIMPLE_TABLE_ROW_TYPE_HEAD);
        $footRow = new SimpleTableRow(SIMPLE_TABLE_ROW_TYPE_FOOT);

        $bodyRow->setStyleClassName('custom-body-row-style-name');
        $footRow->setStyleClassName('custom-foot-row-style-name');

        $this->assertEquals('custom-body-row-style-name', $bodyRow->getStyleClassName());
        $this->assertEquals('', $headRow->getStyleClassName());
        $this->assertEquals('custom-foot-row-style-name', $footRow->getStyleClassName());
    }

    /**
     * @throws SimpleTableException
     */
    public function testGetCustomStyleClassNames()
    {
        $cell = new SimpleTableCell();
        $cell->setStyleClassName('custom-cell-style-name');
        $this->assertEquals('custom-cell-style-name', $cell->getStyleClassName());

        $row = new SimpleTableRow();
        $row->setStyleClassName('custom-row-style-name');
        $this->assertEquals('custom-row-style-name', $row->getStyleClassName());
    }

    /**
     * @throws SimpleTableException
     */
    public function testCellHtml()
    {
        $cell = new SimpleTableCell('content goes here.');
        $this->assertEquals('<td>content goes here.</td>', $cell->__toString());
    }

    /**
     * @throws SimpleTableException
     */
    public function testRowCellHtml()
    {
        $row = new SimpleTableRow();

        $cell = new SimpleTableCell('added cell');
        $cell->setStyleClassName('custom-cell-style-name');

        $row->addCell($cell);
        $row->buildCell('built cell 1');
        $row->buildCell('built cell 2', 'custom-built-cell-style-name');

        $html  = '<tr>';
        $html .= '<td class=\'custom-cell-style-name\'>added cell</td>';
        $html .= '<td>built cell 1</td>';
        $html .= '<td class=\'custom-built-cell-style-name\'>built cell 2</td>';
        $html .= '</tr>';

        $this->assertEquals($html, $row->__toString());
    }

    /**
     * @throws SimpleTableException
     */
    public function testSpans()
    {
        $cell = new SimpleTableCell('content', '', 3, 4);

        $this->assertEquals('<td colspan=3 rowspan=4>content</td>', $cell->__toString());

        $cell->setRowSpan(1);
        $this->assertEquals('<td colspan=3>content</td>', $cell->__toString());

        $cell->setRowSpan(3);
        $cell->setColSpan(1);
        $this->assertEquals('<td rowspan=3>content</td>', $cell->__toString());

        $cell->setStyleClassName('custom-cell-style');
        $this->assertEquals('<td class=\'custom-cell-style\' rowspan=3>content</td>', $cell->__toString());

        $cell->setRowSpan(1);
        $cell->setColSpan(1);
        $cell->clearStyleClassName();
        $this->assertEquals('<td>content</td>', $cell->__toString());
    }

    /**
     * @return SimpleTableTemplate
     * @throws SimpleTableException
     */
    private function setUpTable()
    {
        $table = new SimpleTableTemplate();

        $headRow = new SimpleTableRow(SIMPLE_TABLE_ROW_TYPE_HEAD);
        $headRow->setStyleClassName('custom-thead');
        $headRow->buildCell('Headline with a colspan of 3', '', 3);
        $table->addRow($headRow);

        $bodyRow = new SimpleTableRow();
        $bodyRow->setStyleClassName('custom-tbody');
        for ($i = 1; $i <= 3; $i++)
        {
            $bodyRow->buildCell($i);
        }
        $table->addRow($bodyRow);

        $bodyRow = new SimpleTableRow();
        $bodyRow->setStyleClassName('custom-tbody');
        for ($i = 4; $i <= 6; $i++)
        {
            $bodyRow->buildCell($i, 'custom-cell-style-1');
        }
        $table->addRow($bodyRow);

        $headRow = new SimpleTableRow(SIMPLE_TABLE_ROW_TYPE_HEAD);
        $headRow->setStyleClassName('custom-thead');
        $headRow->buildCell('Headline with a colspan of 2', '', 2);
        $headRow->buildCell('Third Headline Cell');
        $table->addRow($headRow);

        $bodyRow = new SimpleTableRow();
        $bodyRow->setStyleClassName('custom-tbody');
        $bodyRow->buildCell('1');
        $bodyRow->buildCell('2', 'custom-cell-style-1', 2, 2);
        $table->addRow($bodyRow);

        $bodyRow = new SimpleTableRow();
        $bodyRow->setStyleClassName('custom-tbody');
        $bodyRow->buildCell('3');
        $table->addRow($bodyRow);

        $footRow = new SimpleTableRow(SIMPLE_TABLE_ROW_TYPE_FOOT);
        $footRow->setStyleClassName('custom-tfoot');
        $footRow->buildCell('f 1', 'custom-cell-style-2', 1, 2);
        $footRow->buildCell('f 2');
        $footRow->buildCell('f 3', 'custom-cell-style-2', 1, 2);
        $table->addRow($footRow);

        $footRow = new SimpleTableRow(SIMPLE_TABLE_ROW_TYPE_FOOT);
        $footRow->setStyleClassName('custom-tfoot');
        $footRow->buildCell('f 4');
        $table->addRow($footRow);

        return $table;
    }

    /**
     * @throws SimpleTableException
     */
    public function testTable()
    {
        $html = "<table><thead class='custom-thead'><tr><td colspan=3>Headline with a colspan of 3</td></tr></thead><tbody class='custom-tbody'><tr><td>1</td><td>2</td><td>3</td></tr><tr><td class='custom-cell-style-1'>4</td><td class='custom-cell-style-1'>5</td><td class='custom-cell-style-1'>6</td></tr></tbody><thead class='custom-thead'><tr><td colspan=2>Headline with a colspan of 2</td><td>Third Headline Cell</td></tr></thead><tbody class='custom-tbody'><tr><td>1</td><td class='custom-cell-style-1' colspan=2 rowspan=2>2</td></tr><tr><td>3</td></tr></tbody><tfoot class='custom-tfoot'><tr><td class='custom-cell-style-2' rowspan=2>f 1</td><td>f 2</td><td class='custom-cell-style-2' rowspan=2>f 3</td></tr><tr><td>f 4</td></tr></tfoot></table>";

        $table = $this->setUpTable();

        $this->assertEquals($html, $table->__toString());
    }
}