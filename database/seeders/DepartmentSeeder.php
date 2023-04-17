<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name'=>'Eyes'
        ]);
        Department::create([
            'name'=>'Dental'
        ]);
    }
}
