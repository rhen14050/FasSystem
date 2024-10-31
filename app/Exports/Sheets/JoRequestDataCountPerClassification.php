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
use PhpOffice\PhpSpreadsheet\Chart\Chart as Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use Illuminate\Support\Facades\DB;




class JoRequestDataCountPerClassification implements  FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $classificationCount;

    //
    function __construct(
        $classificationCount

    )

    {
        $this->classificationCount = $classificationCount;
    }


        public function view(): View {

                return view('exports.expot_jo_request_data_count_per_classification');

        }

        public function title(): string
        {
            return 'Count Per Classification';
        }



        public function registerEvents(): array
        {
            $classificationCount = $this->classificationCount;

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
                    $classificationCount
                ) {
                    $event->sheet->getColumnDimension('A')->setWidth(45);

                    $classificationCounter = [];
                    $classificationsArray = [];

                    // Count occurrences of each department
                    for ($i = 0; $i < count($classificationCount); $i++) {
                        $classification = trim($classificationCount[$i]['job_classification']); // Remove any extra whitespace
                        if (isset($classificationCounter[$classification])) {
                            $classificationCounter[$classification]++;
                        } else {
                            $classificationCounter[$classification] = 1;
                            $classificationsArray[] = $classification; // Store unique department names
                        }
                    }

                    // Write to the Excel sheet
                    $start_col = 2;
                    $event->sheet->setCellValue('A1', 'Classification');
                    $event->sheet->setCellValue('B1', 'Count');

                    for ($i = 0; $i < count($classificationsArray); $i++) {
                        $event->sheet->getDelegate()->getStyle('A1:B'.$start_col)->applyFromArray($styleBorderAll);
                        $event->sheet->getDelegate()->getStyle('A1:B'.$start_col)->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('A1:B'.$start_col)->getAlignment()->setWrapText(true);

                        $classification = $classificationsArray[$i];
                        $count = $classificationCounter[$classification];
                        if($classification == 1){
                            $class = 'Machine Repair and Troubleshooting';
                        }else if($classification == 2){
                            $class = 'Machine/Equipment Modification';
                        }else if($classification == 3){
                            $class = 'Machine/Equipment Development';
                        }else if($classification == 4){
                            $class = 'Program/Software Development';
                        }
                        $event->sheet->setCellValue('A' . $start_col, $class);
                        $event->sheet->setCellValue('B' . $start_col, $count);
                        $start_col++;
                    }

                },
            ];
        }

    }


