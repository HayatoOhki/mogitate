<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('product_season')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $SplFileObject = new \SplFileObject(__DIR__ . '/data/product_season.csv');
        $SplFileObject->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        foreach ($SplFileObject as $key => $row) {
            if ($key === 0) {
                continue;
            }
            $params[] = [
                'product_id' => trim($row[0]),
                'season_id' => trim($row[1]),
            ];
        }

        DB::table('product_season')->insert($params);
    }
}
