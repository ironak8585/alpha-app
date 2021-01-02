<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;

class GenericExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithTitle, WithMapping
{

    use Exportable, RegistersEventListeners;

    protected $records;
    protected $headings;
    protected $title;
    protected $map;

    /**
     * Constructor
     *
     * @param Collection $records
     * @param array $headings
     */
    public function __construct($records = [], $headings = [], $title = 'Worksheet', $map = null)
    {
        $this->records = $records;
        $this->headings = $headings;
        $this->title = $title;
        $this->map = $map;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->records;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function map($record): array
    {
        if ($this->map) {
            $values = [];
            foreach ($this->map as $key) {
                $values[] = $record[$key];
            }
            return $values;
        } else {
            if (!is_array($record)) {
                if ($record instanceof Collection) {
                    $record = $record->toArray();
                }
                if (is_object($record)) {
                    $record = (array) $record;
                }
            }
            return $record;
        }
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [
            0 => $this,
        ];
        return $sheets;
    }

    /**
     * Set creator
     */
    public static function beforeExport(BeforeExport $event)
    {
        //
        $event->writer->getDelegate()->getProperties()->setCreator(Config::get('constants.APP.EXCEL.CREATOR'));
    }

    /**
     * Set border
     */
    public static function afterSheet(AfterSheet $event)
    {
        //get sheet
        $sheet = $event->sheet->getDelegate();

        //get max rows
        $rows = $sheet->getHighestDataRow();

        //get max cols
        $cols = $sheet->getHighestDataColumn();

        //col label
        //$cols = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(1);

        //set border
        $cellRange = 'A1:' . $cols . $rows;
        $style = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        $sheet->getStyle($cellRange)->applyFromArray($style);

        //set row heights
        $sheet->getRowDimension(1)->setRowHeight(20);

        //bold headers
        $cellRange = 'A1:' . $cols . '1';
        $style = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'font' => [
                'bold' => true,
            ],
        ];
        $sheet->getStyle($cellRange)->applyFromArray($style);
    }
}
