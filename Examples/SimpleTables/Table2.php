<?php

use utilities\SimpleTable\SimpleTableRow;
use utilities\SimpleTable\SimpleTableTemplate;

require '../../vendor/autoload.php';
require 'TableCSSStyle.php';

try
{
    $table = new SimpleTableTemplate();
    $year = date('Y');

    $headerRow = new SimpleTableRow(SIMPLE_TABLE_ROW_TYPE_HEAD);

    /// Add month names to the table.
    /// - We add a colspan of 2 to get the day number + name in this table
    for ($month = 1; $month <= 12; $month++)
    {
        $content = date('F', strtotime("$year-$month-01"));
        $headerRow->buildCell($content, 'calendar-title', 2);
    }

    $table->addRow($headerRow);

    for ($day = 1; $day <= 31; $day++)
    {
        $row = new SimpleTableRow();

        for ($month = 1; $month <= 12; $month++)
        {
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            $number = sprintf('%02d', $day);
            $name = date('D', strtotime("$year-$month-$day"));
            $style = getStyle($month, $day, $name);

            if ($daysInMonth < $day)
            {
                $number = '';
                $name = '';
                $style = 'calendar-none';
            }

            $row->buildCell($number, $style);
            $row->buildCell($name, $style);
        }

        $table->addRow($row);
    }

    echo $table;
}
catch (Exception $ex)
{
    echo $ex->getMessage();
}

function getStyle(int $month, int $day, string $name): string
{
    $style = 'calendar-workday';

    if ($month === 12 && ($day >= 24 && $day <= 26))
    {
        $style = 'calendar-xmas';
    }
    elseif ($name === 'Sat' || $name === 'Sun')
    {
        $style = 'calendar-weekend';
    }

    return $style;
}
