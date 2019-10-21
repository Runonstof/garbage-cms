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
                        {{ __('install.text') }}
                        <br>
                        {{ __('install.text.database') }}
                        <br>
                        <form action="{{ route('koek') }}" method="POST" data-garbage-cms-form class="mt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('install.input.database') }}</span>
                                </div>
                                <input type="text" name="database" class="form-control" value="garbagecms">
                            </div>
                            @if(session()->has('error.database'))
                                <small class="form-text text-{{ session()->get('error.database.color','danger') }}">{{ session()->get('error.database') }}</small>
                            @endif
                            <input class="btn btn-primary mt-3" type="submit" name="submit" value="Save">
                            <pre>
                                
                            </pre>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection()