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

    for ($y = 0; $y < 10; $y++)
    {
        $bodyRow = new SimpleTableRow();
        $bodyRow->setStyleClassName('custom-tbody');

        $style = ($y % 2 === 0) ? 'custom-cell-style-1' : '';

        for ($x = 0; $x < 3; $x++)
        {
            $bodyRow->buildCell("($y|$x)", $style);
        }

        $table->addRow($bodyRow);
    }

    echo '<h1>' . __FILE__ . '</h1>';
    echo $table;
}
catch (Exception $ex)
{
    echo $ex->getMessage();
}