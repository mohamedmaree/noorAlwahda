<?php

namespace App\Imports;

use App\Models\City;
use App\Models\Region;
use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
class CityImport implements ToCollection,WithStartRow
{

    public function collection(Collection $rows)
    {
        $i = 0;
        $insertArr = [];
        foreach ($rows as $row) 
        {
        // $spreadsheet = IOFactory::load(request()->file('file'));
        // $drawing = ($spreadsheet->getActiveSheet()->getDrawingCollection()[$i])??'';
        // // foreach ($spreadsheet->getActiveSheet()->getDrawingCollection() as $drawing) {
        // $myFileName = '' ;
        // if($drawing){
        //     if($drawing instanceof MemoryDrawing) {
        //         ob_start();
        //         call_user_func(
        //             $drawing->getRenderingFunction(),
        //             $drawing->getImageResource()
        //         );
        //         $imageContents = ob_get_contents();
        //         ob_end_clean();
        //         switch ($drawing->getMimeType()) {
        //             case MemoryDrawing::MIMETYPE_PNG :
        //                 $extension = 'png';
        //                 break;
        //             case MemoryDrawing::MIMETYPE_GIF:
        //                 $extension = 'gif';
        //                 break;
        //             case MemoryDrawing::MIMETYPE_JPEG :
        //                 $extension = 'jpg';
        //                 break;
        //         }
        //     }else{
        //             $zipReader = fopen($drawing->getPath(), 'r');
        //             $imageContents = '';
        //             while (!feof($zipReader)) {
        //                 $imageContents .= fread($zipReader, 1024);
        //             }
        //             fclose($zipReader);
        //             $extension = $drawing->getExtension();
        //     }

        //     $myFileName = time().rand(1,9999999). '.' . $extension;
        //     file_put_contents('storage/images/carmodels/' . $myFileName, $imageContents);
            
        //     // $insertArr[] = [
        //     //     'name'   => ['ar' => ($row['0'])??'' , 'en' => ($row['1'])??'' ],
        //     //     'image'  => $myFileName, 
        //     // ];
        // }

        // }
            $i++;
            if(isset($row['2']) || isset($row['3'])){
                $country = $row['0'];
                $region = $row['1'];

                $city = new City();
                $city->name   = ['ar' => ($row['2'])??'' , 'en' => ($row['3'])??'' ];
                $city->region_id  = Region::where('name','like','%'.$region.'%')->first()->id??null;
                $city->country_id  = Country::where('name','like','%'.$country.'%')->first()->id??null;
                $city->save(); 
            }
        }
        // return $CarModel;
    }

    public function startRow(): int
    {
        return 2;
    }


}
