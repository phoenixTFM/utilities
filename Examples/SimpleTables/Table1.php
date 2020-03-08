<?php

use utilities\SimpleTable\SimpleTableRow;
use utilities\SimpleTable\SimpleTableTemplate;

require '../../vendor/autoload.php';
require 'TableCSSStyle.php';

try
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
    $footRow->buildCell('f 2');
    $table->addRow($footRow);

    echo '<h1>' . __FILE__ . '</h1>';
    echo $table;
}
catch (Exception $ex)
{
    echo $ex->getMessage();
}