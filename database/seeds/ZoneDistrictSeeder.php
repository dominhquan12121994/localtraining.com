<?php
/**
 * Copyright (c) 2020. Electric
 */

use Illuminate\Database\Seeder;
use App\Modules\Operators\Models\Entities\ZoneProvinces;
use App\Modules\Operators\Models\Entities\ZoneDistricts;

class ZoneDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrTmp = array();
        $arrData2 = array();
        $path = storage_path() . "/json/wards.json";
        $jsonData = json_decode(file_get_contents($path), true);

        foreach ($jsonData as $data) {
            if (isset($data['wc'])) {
                $data['pc'] = (int)$data['pc'];
                $data['dc'] = (int)$data['dc'];
                $data['wc'] = (int)$data['wc'];
                if (!in_array($data['dc'], $arrTmp)) {
                    $arrTmp[] = $data['dc'];
                    $province = ZoneProvinces::where('code', $data['pc'])->first();
                    if ($province) {
                        $arrData2[] = array(
                            'p_id' => $province->id,
                            'code' => $data['dc'],
                            'name' => $data['d']
                        );
                    }
                }
            }
        }

        ZoneDistricts::insert($arrData2);
    }
}
