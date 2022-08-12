<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Facades\Log;
use Rap2hpoutre\FastExcel\FastExcel;
use DB;

/**
 * Class ProcessCsvData.
 */
class ProcessCsvData
{
    public function importCSVData($data) {
        $file = $data['file'];

        $collection = (new FastExcel)->import($file);

        foreach ($collection as $key => $value) {
            
            $dataFileDetails = [
                'customer_name' => $value['Customer Name'],
                'mobile' => $value['Mobile']
            ];

            DB::table('file_details')->insert($dataFileDetails);
        }
    }
}
