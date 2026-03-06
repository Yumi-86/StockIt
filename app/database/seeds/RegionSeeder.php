<?php

use Illuminate\Database\Seeder;
use App\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            ['name' => '北海道', 'code' => 'HKD', 'jis_code' => '01'],

            ['name' => '青森県', 'code' => 'AOM', 'jis_code' => '02'],
            ['name' => '岩手県', 'code' => 'IWT', 'jis_code' => '03'],
            ['name' => '宮城県', 'code' => 'MYG', 'jis_code' => '04'],
            ['name' => '秋田県', 'code' => 'AKT', 'jis_code' => '05'],
            ['name' => '山形県', 'code' => 'YMT', 'jis_code' => '06'],
            ['name' => '福島県', 'code' => 'FKS', 'jis_code' => '07'],

            ['name' => '茨城県', 'code' => 'IBR', 'jis_code' => '08'],
            ['name' => '栃木県', 'code' => 'TCG', 'jis_code' => '09'],
            ['name' => '群馬県', 'code' => 'GNM', 'jis_code' => '10'],
            ['name' => '埼玉県', 'code' => 'SIT', 'jis_code' => '11'],
            ['name' => '千葉県', 'code' => 'CHB', 'jis_code' => '12'],
            ['name' => '東京都', 'code' => 'TKY', 'jis_code' => '13'],
            ['name' => '神奈川県', 'code' => 'KNG', 'jis_code' => '14'],

            ['name' => '新潟県', 'code' => 'NGT', 'jis_code' => '15'],
            ['name' => '富山県', 'code' => 'TYM', 'jis_code' => '16'],
            ['name' => '石川県', 'code' => 'ISK', 'jis_code' => '17'],
            ['name' => '福井県', 'code' => 'FKI', 'jis_code' => '18'],
            ['name' => '山梨県', 'code' => 'YMN', 'jis_code' => '19'],
            ['name' => '長野県', 'code' => 'NGN', 'jis_code' => '20'],

            ['name' => '岐阜県', 'code' => 'GIF', 'jis_code' => '21'],
            ['name' => '静岡県', 'code' => 'SZK', 'jis_code' => '22'],
            ['name' => '愛知県', 'code' => 'AIC', 'jis_code' => '23'],
            ['name' => '三重県', 'code' => 'MIE', 'jis_code' => '24'],

            ['name' => '滋賀県', 'code' => 'SHG', 'jis_code' => '25'],
            ['name' => '京都府', 'code' => 'KYT', 'jis_code' => '26'],
            ['name' => '大阪府', 'code' => 'OSK', 'jis_code' => '27'],
            ['name' => '兵庫県', 'code' => 'HYG', 'jis_code' => '28'],
            ['name' => '奈良県', 'code' => 'NAR', 'jis_code' => '29'],
            ['name' => '和歌山県', 'code' => 'WKY', 'jis_code' => '30'],

            ['name' => '鳥取県', 'code' => 'TTR', 'jis_code' => '31'],
            ['name' => '島根県', 'code' => 'SMN', 'jis_code' => '32'],
            ['name' => '岡山県', 'code' => 'OKY', 'jis_code' => '33'],
            ['name' => '広島県', 'code' => 'HRS', 'jis_code' => '34'],
            ['name' => '山口県', 'code' => 'YGC', 'jis_code' => '35'],

            ['name' => '徳島県', 'code' => 'TKS', 'jis_code' => '36'],
            ['name' => '香川県', 'code' => 'KAG', 'jis_code' => '37'],
            ['name' => '愛媛県', 'code' => 'EHM', 'jis_code' => '38'],
            ['name' => '高知県', 'code' => 'KCH', 'jis_code' => '39'],

            ['name' => '福岡県', 'code' => 'FUK', 'jis_code' => '40'],
            ['name' => '佐賀県', 'code' => 'SAG', 'jis_code' => '41'],
            ['name' => '長崎県', 'code' => 'NGS', 'jis_code' => '42'],
            ['name' => '熊本県', 'code' => 'KMM', 'jis_code' => '43'],
            ['name' => '大分県', 'code' => 'OIT', 'jis_code' => '44'],
            ['name' => '宮崎県', 'code' => 'MYZ', 'jis_code' => '45'],
            ['name' => '鹿児島県', 'code' => 'KGS', 'jis_code' => '46'],
            ['name' => '沖縄県', 'code' => 'OKN', 'jis_code' => '47'],
        ];

        foreach($regions as $region) {
            Region::updateOrCreate(
                ['jis_code' => $region['jis_code']],
                $region
            );
        }
    }
}
