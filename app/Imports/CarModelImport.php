<?php

namespace App\Imports;

use App\Models\CarBrands;
use App\Models\CarModels;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
class CarModelImport implements ToCollection,WithStartRow
{

    public function collection(Collection $rows)
    {
        $i = 0;
        $insertArr = [];
        foreach ($rows as $row) 
        {
        $spreadsheet = IOFactory::load(request()->file('file'));
        $drawing = ($spreadsheet->getActiveSheet()->getDrawingCollection()[$i])??'';
        // foreach ($spreadsheet->getActiveSheet()->getDrawingCollection() as $drawing) {
        $myFileName = '' ;
        if($drawing){
            if($drawing instanceof MemoryDrawing) {
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $imageContents = ob_get_contents();
                ob_end_clean();
                switch ($drawing->getMimeType()) {
                    case MemoryDrawing::MIMETYPE_PNG :
                        $extension = 'png';
                        break;
                    case MemoryDrawing::MIMETYPE_GIF:
                        $extension = 'gif';
                        break;
                    case MemoryDrawing::MIMETYPE_JPEG :
                        $extension = 'jpg';
                        break;
                }
            }else{
                    $zipReader = fopen($drawing->getPath(), 'r');
                    $imageContents = '';
                    while (!feof($zipReader)) {
                        $imageContents .= fread($zipReader, 1024);
                    }
                    fclose($zipReader);
                    $extension = $drawing->getExtension();
            }

            $myFileName = time().rand(1,9999999). '.' . $extension;
            file_put_contents('storage/images/carmodels/' . $myFileName, $imageContents);
            
            // $insertArr[] = [
            //     'name'   => ['ar' => ($row['0'])??'' , 'en' => ($row['1'])??'' ],
            //     'image'  => $myFileName, 
            // ];
        }

        // }
            $i++;
            if(isset($row['1']) || isset($row['2'])){
                $brand = $row['0'];
                $CarModel = new CarModels;
                $CarModel->name   = ['ar' => ($row['1'])??'' , 'en' => ($row['2'])??'' ];
                $CarModel->image  = ($myFileName)??'';
                $CarModel->car_brand_id  = CarBrands::where('name','like','%'.$brand.'%')->first()->id??null;
                $CarModel->save(); 
            }
        }
        // return $CarModel;
    }

    public function startRow(): int
    {
        return 2;
    }


}

