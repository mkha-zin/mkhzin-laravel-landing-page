<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()->create([
            'title_ar' => 'مخازن سوبر ماركت',
            'title_en' => 'Mkhazin Super Market',
            'description_ar' => 'القسم الرئيسي',
            'description_en' => 'Main Department',
            'key' => 'super',
            'tags_ar' => ['Main Department', 'Mkhazin Super Market', 'Mkhazin', 'Super Market', 'Market', 'Mkhazin Super Market', 'Mkhazin Super Market', 'Mkhazin Super Market'],
            'tags_en' => ['Main Department', 'Mkhazin Super Market', 'Mkhazin', 'Super Market', 'Market', 'Mkhazin Super Market', 'Mkhazin Super Market', 'Mkhazin Super Market'],
        ]);

        Department::factory()->create([
            'title_ar' => 'مخازن هايبر ماركت',
            'title_en' => 'Mkhazin Hyber Market',
            'description_ar' => 'القسم الرئيسي',
            'description_en' => 'Main Department',
            'key' => 'hyper',
            'tags_ar' => ['Main Department', 'Mkhazin Hyber Market', 'Mkhazin', 'Hyber Market', 'Market', 'Mkhazin Hyber Market', 'Mkhazin Hyber Market', 'Mkhazin Hyber Market'],
            'tags_en' => ['Main Department', 'Mkhazin Super Market', 'Mkhazin', 'Super Market', 'Market', 'Mkhazin Super Market', 'Mkhazin Super Market', 'Mkhazin Super Market'],
        ]);

        Department::factory()->create([
            'title_ar' => 'مخازن الجملة',
            'title_en' => 'Mkhazin whole sale',
            'description_ar' => 'القسم الرئيسي',
            'description_en' => 'Main Department',
            'key' => 'wholesale',
            'tags_ar' => ['Main Department', 'Mkhazin whole sale', 'Mkhazin', 'whole sale', 'Mkhazin whole sale', 'Mkhazin whole sale', 'Mkhazin whole sale', 'Mkhazin whole sale'],
            'tags_en' => ['Main Department', 'Mkhazin Super Market', 'Mkhazin', 'Super Market', 'Market', 'Mkhazin Super Market', 'Mkhazin Super Market', 'Mkhazin Super Market'],
        ]);
    }
}
