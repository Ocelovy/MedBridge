@extends('layouts.app')

@section('content')
    <div class="container" id="center">
        <h2 class="text-center">Zoznam pacientov</h2>

        <ul>
            @foreach ($patients as $patient)
                <li>{{ $patient->first_name }} {{ $patient->last_name }} - {{ $patient->email }}</li>
            @endforeach
        </ul>
    </div>
@endsection
