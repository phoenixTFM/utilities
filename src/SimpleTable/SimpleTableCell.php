<?php


namespace utilities\SimpleTable;

/**
 * Class SimpleTableCell
 * @package utilities\SimpleTables
 */
class SimpleTableCell implements ISimpleTableCell
{
    use TSimpleTableStyle;

    private string $content = '';
    private int $colSpan = 0;
    private int $rowSpan = 0;

    /**
     * SimpleTableCell constructor.
     * @param string $content
     * @param string $style
     * @param int $colSpan
     * @param int $rowSpan
     * @throws SimpleTableException
     */
    public function __construct(string $content = '', string $style = '', int $colSpan = 1, int $rowSpan = 1)
    {
        $this->setContent($content);
        $this->setColSpan($colSpan);
        $this->setRowSpan($rowSpan);
        $this->setStyleClassName($style);
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $style = $this->getStyleClassNameAsHtml();

        $colspan = $this->getColSpan();
        $colspan = ($colspan > 1) ? " colspan=$colspan" : '';

        $rowspan = $this->getRowSpan();
        $rowspan = ($rowspan > 1) ? " rowspan=$rowspan" : '';

        return "<td$style$colspan$rowspan>" . $this->content . '</td>';
    }

    /**
     * @inheritDoc
     */
    public function getColSpan(): int
    {
        return $this->colSpan;
    }

    /**
     * @inheritDoc
     */
    public function getRowSpan(): int
    {
        return $this->rowSpan;
    }

    /**
     * Sets the span of the cell.
     *
     * @param int $span
     * @param string $spanType
     * @throws SimpleTableException
     */
    private function setSpan(int $span, string $spanType)
    {
        if ($span < 1)
        {
            throw new SimpleTableException('Invalid span "' . $span . '"');
        }

        switch ($spanType)
        {
            case 'col':
                $this->colSpan = $span;
                break;
            case 'row':
                $this->rowSpan = $span;
                break;
            default:
                throw new SimpleTableException('Invalid span type "' . $spanType . '"');
        }
    }

    /**
     * @inheritDoc
     * @throws SimpleTableException
     */
    public function setColSpan(int $span): ISimpleTableCell
    {
        $this->setSpan($span, 'col');
        return $this;
    }

    /**
     * @inheritDoc
     * @throws SimpleTableException
     */
    public function setRowSpan(int $span): ISimpleTableCell
    {
        $this->setSpan($span, 'row');
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContent(string $content): ISimpleTableCell
    {
        $this->content = $content;
        return $this;
    }
}