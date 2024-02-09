<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateDoctorRecords extends Seeder
{
    public function run()
    {
        $doctors = User::where('role', 'Doktor')->get();

        foreach ($doctors as $doctor) {
            Doctor::create([
                'user_id' => $doctor->id,
                'specialization' => 'Žiadna',
            ]);
        }
    }
}
