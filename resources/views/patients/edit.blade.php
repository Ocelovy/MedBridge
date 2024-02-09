@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Úprava pacienta</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-md-12">
                <label for="inputName" class="form-label">Meno a priezvisko<span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" id="inputName" placeholder="Zadajte celé meno" value="{{ $patient->name }}" required>
            </div>
            <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Zadajte email" value="{{ $patient->email }}">
            </div>
            <div class="col-md-6">
                <label for="inputPhone" class="form-label">Telefónne číslo</label>
                <input type="tel" name="phone" class="form-control" id="inputPhone" placeholder="Zadajte telefónne číslo" value="{{ $patient->phone }}">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Adresa</label>
                <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Ulica, Mesto" value="{{ $patient->name }}">
            </div>
            <div class="form-group">
                <label for="birth_number">Rodné číslo:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="birth_number" name="birth_number" value="{{ $patient->birth_number }}" required>
            </div>
            <div class="form-group">
                <label for="insurance_code">Kód poisťovne:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="insurance_code" name="insurance_code" placeholder="24, 25, 27" value="{{ $patient->insurance_code }}" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Aktualizovať pacienta</button>
                <a href="{{ route('patients.index') }}" class="btn btn-secondary">Zrušiť</a>
            </div>
        </form>
    </div>
@endsection
