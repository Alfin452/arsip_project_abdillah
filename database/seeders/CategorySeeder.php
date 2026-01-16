<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'code' => 'UND',
                'name' => 'Undangan',
                'description' => 'Surat undangan rapat atau acara resmi'
            ],
            [
                'code' => 'SK',
                'name' => 'Surat Keputusan',
                'description' => 'Surat keputusan pengangkatan, pemberhentian, dll'
            ],
            [
                'code' => 'SE',
                'name' => 'Surat Edaran',
                'description' => 'Pemberitahuan resmi ke seluruh staff'
            ],
            [
                'code' => 'TGS',
                'name' => 'Surat Tugas',
                'description' => 'Perintah perjalanan dinas atau tugas khusus'
            ],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
