@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index2.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')
    <div class="container" id="center">
        <h2 class="text-center">Formulár pre pridanie pacienta</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('patients.store') }}" class="row g-3">
            @csrf
            <div class="col-md-12">
                <label for="inputName" class="form-label">Meno a priezvisko<span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" id="inputName" placeholder="Zadajte celé meno" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Zadajte email" value="{{ old('email') }}">
            </div>
            <div class="col-md-6">
                <label for="inputPhone" class="form-label">Telefónne číslo</label>
                <input type="tel" name="phone" class="form-control" id="inputPhone" placeholder="Zadajte telefónne číslo" value="{{ old('phone') }}">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Adresa</label>
                <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Ulica, Mesto" value="{{ old('address') }}">
            </div>
            <div class="form-group">
                <label for="birth_number">Rodné číslo:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="birth_number" name="birth_number" value="{{ old('birth_number') }}" required>
            </div>
            <div class="form-group">
                <label for="insurance_code">Kód poisťovne:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="insurance_code" name="insurance_code" placeholder="24, 25, 27" value="{{ old('insurance_code') }}" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary addPatientButton">Pridať pacienta</button>
                <button type="submit" class="btn btn-primary updatePatientButton" style="display:none;">Aktualizovať pacienta</button>
            </div>
        </form>
    </div>

    @if(isset($patients) && $patients->count() > 0)
        <div class="container mt-5">
            <h3>Zoznam pacientov</h3>
            <table class="custom-table">
                <thead>
                <tr>
                    <th>Meno</th>
                    <th>Email</th>
                    <th>Telefón</th>
                    <th>Adresa</th>
                    <th>Rodné číslo</th>
                    <th>Kód poisťovne</th>
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <th>Akcie</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->address }}</td>
                        <td>{{ $patient->birth_number }}</td>
                        <td>{{ $patient->insurance_code }}</td>
                        <td>
                            @if(auth()->check() && auth()->user()->isAdmin() || auth()->user()->isDoktor())
                                <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-primary btn-sm">Editovať</a>
                                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Odstrániť</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="container mt-5">
            <div class="alert alert-info" role="alert">
                Žiadni pacienti na zobrazenie.
            </div>
        </div>
    @endif

@endsection
