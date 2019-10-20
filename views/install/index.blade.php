@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-3"></div>
        <div class="col-md-5">
            <div class="card text-white bg-info">
                <div class="card-header">
                    {{ __('install.title') }}
                </div>
                <div class="card-body">
                    {{ __('install.text') }}
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection()