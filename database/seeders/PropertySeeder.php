<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $file = fopen(database_path('csv/property-data.csv'), 'r');
        fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            Property::query()
                ->create([
                    'name' => $row[0],
                    'price' => $row[1],
                    'bedrooms' => $row[2],
                    'bathrooms' => $row[3],
                    'storeys' => $row[4],
                    'garages' => $row[5],
                ]);
        }

        fclose($file);
    }
}
