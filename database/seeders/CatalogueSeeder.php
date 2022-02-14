<?php

namespace Database\Seeders;

use App\Models\Catalogue;
use Illuminate\Database\Seeder;

class CatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catalogues = [
            ['id' => 1, 'name' => 'Sra.', 'type' => 'title'],
            ['id' => 2, 'name' => 'Srta.', 'type' => 'title'],
            ['id' => 3, 'name' => 'Sr.', 'type' => 'title'],
            ['id' => 4, 'name' => 'Ing.', 'type' => 'title'],
            ['id' => 5, 'name' => 'Lic.', 'type' => 'title'],
            ['id' => 6, 'name' => 'Arq.', 'type' => 'title'],
            ['id' => 7, 'name' => 'Crnl.', 'type' => 'title'],           
            ['id' => 8, 'name' => 'Doc.', 'type' => 'title'],
            ['id' => 9, 'name' => 'Muy Alta.', 'type' => 'priority_possibility'],           
            ['id' => 10, 'name' => 'Alta.', 'type' => 'priority_possibility'],           
            ['id' => 11, 'name' => 'Moderada.', 'type' => 'priority_possibility'],           
            ['id' => 12, 'name' => 'Poca.', 'type' => 'priority_possibility'],           
            ['id' => 14, 'name' => 'Muy Poca.', 'type' => 'priority_possibility'],           
            ['id' => 15, 'name' => 'Novio.', 'type' => 'family'],           
            ['id' => 16, 'name' => 'Novia.', 'type' => 'family'],          
        ];

        foreach($catalogues as $catalogue){
            Catalogue::create($catalogue);
        }
    }
}
