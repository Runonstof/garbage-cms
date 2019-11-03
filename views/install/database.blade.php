@extends('admin.layouts.app', ['class' => 'install-page'])

@section('content')
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>
                                {{ __('install.title') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        {!! __('install.text') !!}
                        <br>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection()