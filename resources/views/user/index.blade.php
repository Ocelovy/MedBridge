@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index2.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('alert'))
            <div class="row">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('alert') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <div class="row">
                @can('create', \App\Models\User::class)
                <div class="mb-3">
                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-success" role="button"><i
                    class="bi bi-plus-circle"></i> {{ __('Pridať používateľa') }} </a>
                </div>
                @endcan
            </div>
            <div class="row">
                {!! $grid->show() !!}
            </div>
        </div>
    </div>
</div>
@endsection
