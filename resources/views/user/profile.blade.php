@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index4.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="profile-img mb-3 text-center">
                    @if ($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Profilová fotka" class="img-thumbnail mb-3" id="photo">
                        <form action="{{ route('user.deletePhoto') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Ste si istí, že chcete odstrániť túto fotku?')">Odstrániť fotku</button>
                        </form>
                    @else
                        <img src="{{ asset('placeholder.png') }}" alt="Žiadna profilová fotka" class="img-thumbnail">
                    @endif
                </div>
                <form action="{{ route('user.updatePhoto') }}" method="POST" enctype="multipart/form-data" class="mb-3">
                    @csrf
                    <div class="mb-3">
                        <input type="file" class="form-control" name="photo" id="photo" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Nahrať fotku</button>
                </form>
            </div>

            <div class="col-md-8">
                <div class="profile-info">
                    <h2>Profil</h2>
                    <p><strong>Meno:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
