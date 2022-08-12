<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $sectorNames = ['Manufacturing', 'Other', 'Service'];
        foreach($sectorNames as $sectorName) {
            $sector = new Sector();
            $sector->name = $sectorName;
            $sector->save();
        }
    }
}
