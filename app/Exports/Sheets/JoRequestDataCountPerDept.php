<?php

namespace App\Exports\Sheets;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
Use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithCharts;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use Illuminate\Support\Facades\DB;




class JoRequestDataCountPerDept implements  FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $deptCount;

    //
    function __construct(
        $deptCount
    )

    {
        $this->deptCount = $deptCount;
    }


        public function view(): View {

                return view('exports.expot_jo_request_data_count_per_dept');

        }

        public function title(): string
        {
            return 'JO Count per Dept';
        }



        public function registerEvents(): array
        {
            $deptCount = $this->deptCount;

            $arial_font13 = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  13,
                    // 'color'      =>  'red',
                    // 'italic'      =>  true
                )
            );

            $calibri_font9 = array(
                'font' => array(
                    'name'      =>  'Calibri',
                    'size'      =>  9,
                    'bold'      =>  true
                    // 'italic'      =>  true
                )
            );

            $arial_font12_bold = array(
                'font' => array(
                    'name'      =>  'Calibri',
                    'size'      =>  11,
                    'bold'      =>  true,
                    // 'italic'      =>  true
                )
            );

            $arial_font12 = array(
                'font' => array(
                    'name'      =>  'Arial',
                    'size'      =>  12,
                    // 'bold'      =>  true,
                    // 'italic'      =>  true
                )
            );

            $hv_center = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrap' => TRUE
                ]
            );

            $hlv_center = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrap' => TRUE
                ]
            );

            $hrv_center = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            );
            $styleBorderBottomThin= [
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            $styleBorderAll = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];

            $hlv_top = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrap' => TRUE
                ]
            );

            $hcv_top = array(
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrap' => TRUE
                ]
            );

            $calibri_font9_nb = array(
                'font' => array(
                    'name'      =>  'Calibri',
                    'size'      =>  9,
                    // 'bold'      =>  true
                    // 'italic'      =>  true
                )
            );

            $calibri_font8_nb = array(
                'font' => array(
                    'name'      =>  'Calibri',
                    'size'      =>  8,
                    // 'bold'      =>  true
                    // 'italic'      =>  true
                )
            );



            return [
                AfterSheet::class => function(AfterSheet $event) use (
                    $arial_font13,
                    $hv_center,
                    $hlv_center,
                    $hrv_center,
                    $styleBorderBottomThin,
                    $styleBorderAll,
                    $hlv_top,
                    $hcv_top,
                    $calibri_font9,
                    $arial_font12_bold,
                    $arial_font12,
                    $calibri_font9_nb,
                    $calibri_font8_nb,
                    $deptCount
                ) {
                    $event->sheet->getColumnDimension('A')->setWidth(15);

                    $deptCounter = [];
                    $departmentsArray = [];

                    // Count occurrences of each department
                    for ($i = 0; $i < count($deptCount); $i++) {
                        $department = trim($deptCount[$i]['department']); // Remove any extra whitespace
                        if (isset($deptCounter[$department])) {
                            $deptCounter[$department]++;
                        } else {
                            $deptCounter[$department] = 1;
                            $departmentsArray[] = $department; // Store unique department names
                        }
                    }

                    // Write to the Excel sheet
                    $start_col = 2;
                    $event->sheet->setCellValue('A1', 'Department');
                    $event->sheet->setCellValue('B1', 'Count');

                    for ($i = 0; $i < count($departmentsArray); $i++) {
                        $event->sheet->getDelegate()->getStyle('A1:B'.$start_col)->applyFromArray($styleBorderAll);
                        $event->sheet->getDelegate()->getStyle('A1:B'.$start_col)->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('A1:B'.$start_col)->getAlignment()->setWrapText(true);

                        $department = $departmentsArray[$i];
                        $count = $deptCounter[$department];
                        $event->sheet->setCellValue('A' . $start_col, $department);
                        $event->sheet->setCellValue('B' . $start_col, $count);
                        $start_col++;
                    }
                    
                },
            ];
        }

    }


