@extends('admin.layouts.app', ['class' => 'error-page'])

@section('content')
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>
                                {{ $error_title ?? __('install.error.title') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        {!! $error_text ?? __('install.error.text') !!}
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection()