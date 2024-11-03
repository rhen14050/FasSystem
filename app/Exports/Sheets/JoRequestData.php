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




class JoRequestData implements  FromView, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $joRequestDetails;

    //
    function __construct(
        $joRequestDetails
    )

    {
        $this->joRequestDetails = $joRequestDetails;
    }


        public function view(): View {

                return view('exports.expot_jo_request_data');

        }

        public function title(): string
        {
            return 'JO Request Details';
        }



        public function registerEvents(): array
        {
            $joRequestDetails = $this->joRequestDetails;

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
                    $joRequestDetails
                ) {
                    $event->sheet->getColumnDimension('A')->setWidth(20);
                    $event->sheet->getColumnDimension('B')->setWidth(20);
                    $event->sheet->getColumnDimension('C')->setWidth(20);
                    $event->sheet->getColumnDimension('D')->setWidth(20);
                    $event->sheet->getColumnDimension('E')->setWidth(20);
                    $event->sheet->getColumnDimension('F')->setWidth(20);
                    $event->sheet->getColumnDimension('G')->setWidth(15);
                    $event->sheet->getColumnDimension('H')->setWidth(20);
                    $event->sheet->getColumnDimension('I')->setWidth(20);
                    $event->sheet->getColumnDimension('J')->setWidth(20);
                    $event->sheet->getColumnDimension('K')->setWidth(20);
                    $event->sheet->getColumnDimension('L')->setWidth(20);
                    $event->sheet->getColumnDimension('M')->setWidth(20);
                    $event->sheet->getColumnDimension('N')->setWidth(20);
                    $event->sheet->getColumnDimension('O')->setWidth(20);
                    $event->sheet->getColumnDimension('P')->setWidth(20);
                    $event->sheet->setCellValue('A1', 'JO Request Details');
                    $event->sheet->setCellValue('I1', 'Conformance Details');
                    $event->sheet->setCellValue('P1', 'Status');
                    $event->sheet->getDelegate()->mergeCells('A1:H1');
                    $event->sheet->getDelegate()->mergeCells('I1:O1');
                    $event->sheet->getDelegate()->mergeCells('P1:P2');


                    $event->sheet->setCellValue('A2', 'Control Number');
                    $event->sheet->setCellValue('B2', 'Department/Section');
                    $event->sheet->setCellValue('C2', 'Job Description');
                    $event->sheet->setCellValue('D2', 'Initial Action');
                    $event->sheet->setCellValue('E2', 'Equipment Name');
                    $event->sheet->setCellValue('F2', 'Equipment Number');
                    $event->sheet->setCellValue('G2', 'Allocated Budget');
                    $event->sheet->setCellValue('H2', 'Prepared by');


                    $event->sheet->setCellValue('I2', 'FAS Assessmemnt');
                    $event->sheet->setCellValue('J2', 'Job Classification');
                    $event->sheet->setCellValue('K2', 'Recommendation');
                    $event->sheet->setCellValue('L2', 'Other Recommendation');
                    $event->sheet->setCellValue('M2', 'Estimated Completion Date');
                    $event->sheet->setCellValue('N2', 'Estimated Cost');
                    $event->sheet->setCellValue('O2', 'Assessed by');

                    $start_col = 3;
                    for ($i = 0; $i < count($joRequestDetails); $i++) {
                        $event->sheet->getDelegate()->getStyle('A1:P'.$start_col)->applyFromArray($styleBorderAll);
                        $event->sheet->getDelegate()->getStyle('A1:P'.$start_col)->applyFromArray($hv_center);
                        $event->sheet->getDelegate()->getStyle('A1:P'.$start_col)->getAlignment()->setWrapText(true);

                        if($joRequestDetails[$i]->currency == 1){
                            $currency = '$';
                        }else{
                            $currency = 'PHP';
                        }

                        if($joRequestDetails[$i]->status != 3){
                            $status = 'JO Ongoing';
                            $event->sheet->getDelegate()->getStyle('A'.$start_col.':'.'P'.$start_col)
                            ->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setARGB('fffc04');
                        }else{
                            $status = 'Completed';
                            $event->sheet->getDelegate()->getStyle('A'.$start_col.':'.'P'.$start_col)
                            ->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setARGB('9ACD32');
                        }

                        $event->sheet->setCellValue('A'.$start_col, $joRequestDetails[$i]->jo_ctrl_no);
                        $event->sheet->setCellValue('B'.$start_col, $joRequestDetails[$i]->department);
                        $event->sheet->setCellValue('C'.$start_col, $joRequestDetails[$i]->job_description);
                        $event->sheet->setCellValue('D'.$start_col, $joRequestDetails[$i]->initial_action);
                        $event->sheet->setCellValue('E'.$start_col, $joRequestDetails[$i]->equipment_name);
                        $event->sheet->setCellValue('F'.$start_col, $joRequestDetails[$i]->equipment_no);
                        $event->sheet->setCellValue('G'.$start_col, $currency.$joRequestDetails[$i]->allocated_budget);
                        $event->sheet->setCellValue('H'.$start_col, $joRequestDetails[$i]->rapidx_user_details->name);

                        if(isset($joRequestDetails[$i]->jo_requests_conformance)){

                            if($joRequestDetails[$i]->jo_requests_conformance->job_classification == 1){
                                $classification = 'Machine Repair and Troubleshooting';
                            }
                            else if($joRequestDetails[$i]->jo_requests_conformance->job_classification == 2){
                                $classification = 'Machine/Equipment Modification';
                            }
                            else if($joRequestDetails[$i]->jo_requests_conformance->job_classification == 3){
                                $classification = 'Machine/Equipment Development';
                            }
                            else if($joRequestDetails[$i]->jo_requests_conformance->job_classification == 4){
                                $classification = 'Program/Software Development';
                            }

                            $event->sheet->setCellValue('I'.$start_col, $joRequestDetails[$i]->jo_requests_conformance->fas_assessment);
                            $event->sheet->setCellValue('J'.$start_col, $classification);
                            if($joRequestDetails[$i]->jo_requests_conformance->recommendation == 1){
                                $recommendation = 'Internal Job by FAS';
                                $event->sheet->setCellValue('L'.$start_col, '---');
                            }
                            else if($joRequestDetails[$i]->jo_requests_conformance->recommendation == 2){
                                $recommendation = 'Need External Supplier';
                                $event->sheet->setCellValue('L'.$start_col, '---');
                            }else{
                                $recommendation = 'Others';
                                $event->sheet->setCellValue('L'.$start_col, $joRequestDetails[$i]->jo_requests_conformance->others_recommendation);
                            }

                            if($joRequestDetails[$i]->jo_requests_conformance->estimated_type == 1){
                                $est_currency = '$';
                            }else{
                                $est_currency = 'PHP';
                            }

                            
                            $event->sheet->setCellValue('J'.$start_col, $classification);
                            $event->sheet->setCellValue('K'.$start_col, $recommendation);

                            $event->sheet->setCellValue('M'.$start_col, $joRequestDetails[$i]->jo_requests_conformance->estimated_completion_date);
                            $event->sheet->setCellValue('N'.$start_col, $est_currency.$joRequestDetails[$i]->jo_requests_conformance->estimated_cost);
                            $event->sheet->setCellValue('O'.$start_col, $joRequestDetails[$i]->jo_requests_conformance->rapidx_user_details->name);
                        }



                        
                        $event->sheet->setCellValue('P'.$start_col, $status);
                        $start_col++;
                    }

                },
            ];
        }

    }


