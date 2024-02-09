<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use function Laravel\Prompts\error;

function validateBirthNumber($value) {
    if (strlen($value) != 10) {
        return false;
    }

    $year = intval(substr($value, 0, 2));
    $month = intval(substr($value, 2, 2));
    $day = intval(substr($value, 4, 2));
    $ext = intval(substr($value, 6, 4));

    if ($month > 12) {
        $month -= 50;
        if ($month < 1 || $month > 12 || $day < 1 || $day > 31) {
            return false;
        }
    }

    if (!checkdate($month, $day, $year)) {
        return false;
    }
    return true;
}


class PatientController extends Controller
{
    public function create()
    {
        return view('patients.create');
    }

    public function pacientView()
    {
        $patients = Patient::all();
        return view('/patients/pacient', compact('patients'));
    }

    public function getPatientInfo(Patient $patient)
    {
        $user = auth()->user();
        if ($user->isDoktor() || $user->isAdmin()) {
            $patients = Patient::all();
            return response()->json($patient);
        } else {
            return view("/");
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'nullable|email|unique:patients,email',
            'phone' => 'nullable|string|max:20|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
            'address' => 'nullable|string|max:255',
            'birth_number' => ['required', 'regex:/^\d{10}$/', 'unique:patients,birth_number', function ($attribute, $value, $fail) {

                if (!validateBirthNumber($value)) {
                    $fail('Rodné číslo je neplatné.');
                }
            }],
            'insurance_code' => 'required|string|in:0,24,25,27',
        ]);

        Patient::create($validatedData);
        return redirect()->route('patients.index')->with('success', 'Pacient bol úspešne pridaný.');
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->isDoktor() || $user->isAdmin()) {
            $patients = Patient::all();
        return view('/patients/pacient', compact('patients'));
        } else {
            return view("/");
        }
    }

    public function edit(Patient $patient)
    {
        $user = auth()->user();
        if ($user->isDoktor() || $user->isAdmin()) {
            $patients = Patient::all();
            return view('patients.edit', compact('patient'));
        } else {
            return view("/");
        }
    }

    public function update(Request $request, Patient $patient)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => ['nullable', 'email', Rule::unique('patients')->ignore($patient->id)],
            'phone' => 'nullable|string|max:20|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
            'address' => 'nullable|string|max:255',
            'birth_number' => ['required', 'regex:/^\d{10}$/', Rule::unique('patients')->ignore($patient->id), function ($attribute, $value, $fail) {
                if (!validateBirthNumber($value)) {
                    $fail('Rodné číslo je neplatné.');
                }
            }],
            'insurance_code' => 'required|string|in:0,24,25,27',
        ]);

        $patient->update($validatedData);
        return redirect()->route('patients.index')->with('success', 'Pacient bol úspešne aktualizovaný.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return back()->with('success', 'Pacient bol úspešne odstránený.');
    }
}
