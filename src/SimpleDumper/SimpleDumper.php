<?php


namespace utilities\SimpleDumper;

/**
 * Class SimpleDumper
 * @package utilities\Dumper
 */
final class SimpleDumper
{
    private function __construct() { }
    private function __clone() { }
    private function __wakeup() { }

    /**
     * Parses the elements of the $backtrace subarrays 'file' 'class', 'function', 'line' to a string.
     * Separator PHP_EOL.
     *
     * @param array $backtrace multidimensional array
     * @return string the trace-string
     */
    public static function getBacktrace(array $backtrace): string
    {
        $output = '';

        foreach ($backtrace as $trace)
        {
            $output .= '# ' . $trace['class'] . '::' . $trace['function'] . ' at "' . $trace['file'] . '" on line "' . $trace['line'] . '"' . PHP_EOL;
        }

        return $output;
    }

    /**
     * Dumps the params as HTML.
     *
     * @param mixed ...$params
     */
    public static function dumpAsHtml(...$params): void
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        $styleBorder = 'border: 1px solid black; padding: 3px; font-family: courier; font-size: 12px;';

        $output  = '<fieldset style="background-color: #969696;">';
        $output .= "<legend style='background-color: #fff; $styleBorder'>" . __FUNCTION__ . '</legend>';
        $output .= "<div style='background-color: #fff; $styleBorder'><pre>";
        $output .= str_replace(PHP_EOL, '<br>', self::getBacktrace($backtrace));
        $output .= '</pre></div>';
        $output .= '<br>';

        foreach ($params as $param)
        {
            $output .= "<div style='background-color: #c2bcbc; margin-bottom: 5px; $styleBorder'><pre>" . var_export($param, true) . '</pre></div>';
        }

        $output .= '</div></fieldset>';

        echo $output;
    }
}