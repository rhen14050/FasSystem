<?php

namespace App\Exports;



use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
Use \Maatwebsite\Excel\Sheet;
// use Maatwebsite\Excel\Concerns\WithDrawings;
// use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


use App\Exports\Sheets\JoRequestData;
use App\Exports\Sheets\JoRequestDataCountPerDept;
use App\Exports\Sheets\JoRequestDataCountPerClassification;

// use App\Exports\Sheets\JoRequestData;
// use App\Exports\Sheets\JoRequestDataCountPerDept;
// use App\Exports\Sheets\JoRequestDataCountPerClassification;




// class UsersExports implements  FromView, WithTitle, WithEvents, WithMultipleSheets
class exportJoRequestReport implements  WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $deptCount;
    protected $classificationCount;


    function __construct(
        $deptCount,
        $classificationCount
    ){
        $this->deptCount = $deptCount;
        $this->classificationCount = $classificationCount;
    }


    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new JoRequestData();
        $sheets[] = new JoRequestDataCountPerDept($this->deptCount);
        $sheets[] = new JoRequestDataCountPerClassification($this->classificationCount);

        return $sheets;
    }



}
