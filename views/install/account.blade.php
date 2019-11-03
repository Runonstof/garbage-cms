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
                        {!! __('install.text.email') !!}
                        <br>
                        <form action="{{ route('install.register') }}" method="POST" data-garbage-cms-form class="mt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('install.input.email') }}</span>
                                </div>
                            <input type="email" name="email" class="form-control" placeholder="{{ __('install.input.email.placeholder') }}" value="{{ old('email') }}">
                            </div>
                            @if(session()->has('error.email'))
                                <small class="form-text text-{{ session()->get('error.email.color','danger') }}">{!! session()->get('error.email') !!}</small>
                            @endif
                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('install.input.password') }}</span>
                                </div>
                                <input type="password" name="password" class="form-control">
                            </div>
                            @if(session()->has('error.password'))
                                <small class="form-text text-{{ session()->get('error.password.color','danger') }}">{!! session()->get('error.password') !!}</small>
                            @endif
                            

                            <input class="btn btn-primary mt-3" type="submit" name="submit" value="Save">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection()