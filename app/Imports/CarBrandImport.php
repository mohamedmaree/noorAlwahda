<?php

namespace App\Imports;

use App\Models\CarBrands;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
class CarBrandImport implements ToCollection,WithStartRow
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
            file_put_contents('storage/images/carbrands/' . $myFileName, $imageContents);
            
            // $insertArr[] = [
            //     'name'   => ['ar' => ($row['0'])??'' , 'en' => ($row['1'])??'' ],
            //     'image'  => $myFileName, 
            // ];
        }

        // }
          $i++;
          if(isset($row['0']) || isset($row['1'])){
            $CarBrand = new CarBrands();
            $CarBrand->name   = ['ar' => ($row['0'])??'' , 'en' => ($row['1'])??'' ];
            $CarBrand->image  = ($myFileName)??'';
            $CarBrand->save(); 
          }
        }
        // return $CarBrand;
    }

    public function startRow(): int
    {
        return 2;
    }


}

