<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();

        return view('kontakt', ['doctors' => $doctors]);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
