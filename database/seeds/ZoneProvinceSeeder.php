<?php

use Illuminate\Database\Seeder;
use App\Modules\Operators\Models\Entities\ZoneProvinces;

class ZoneProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrTmp = array();
        $arrData1 = array();
        $path = storage_path() . "/json/wards.json";
        $jsonData = json_decode(file_get_contents($path), true);

        foreach ($jsonData as $data) {
            if (isset($data['wc'])) {
                $data['pc'] = (int) $data['pc'];
                $data['dc'] = (int) $data['dc'];
                $data['wc'] = (int) $data['wc'];
                if (!in_array($data['pc'], $arrTmp)) {
                    $arrTmp[] = $data['pc'];
                    $arrData1[] = array(
                        'code' => $data['pc'],
                        'name' => $data['p']
                    );
                }
            }
        }

        ZoneProvinces::insert($arrData1);
    }
}
