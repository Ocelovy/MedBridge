@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index4.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <h2>Kontakt na doktorov</h2>

            <div class="search-filter mb-3">
                <input type="text" id="doctorSearch" class="form-control" placeholder="Hľadať doktora...">
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                @foreach ($doctors as $doctor)
                    <div class="col mb-4">
                        <div class="card doctor-card">
                            <img src="{{ $doctor->user->photo ? asset('storage/' . $doctor->user->photo) : asset('.images/placeholder.jpg') }}" class="card-img-top" alt="Profilová fotka doktora" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $doctor->user->name }}</h5>
                                <p class="card-text">Špecializácia: {{ $doctor->specialization }}</p>
                                <p class="card-text">Telefónne číslo: {{ $doctor->phone_number }}</p>
                                <p class="card-text">Kontaktný email: {{ $doctor->user->email }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection


