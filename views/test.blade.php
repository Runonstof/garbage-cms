<!-- HTML here -->
@extends('layouts.app')

@section('content')
   
<div class="row nav-row">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="col-2">
            <a class="navbar-brand" href="#">
                <h3 class="my-auto text-left mr-5">LOGO</h3>
            </a>
        </div>
        <div class="collapse navbar-collapse ml-5" id="navbar">
            <ul class="navbar-nav pl-5">
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-success mx-2">Help</button>
                </li>
                <li class="nav-item">
                    <button type="button"  class="btn btn-outline-success mx-2">About</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-success mx-2">Account</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-success mx-2"> Log In</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-success mx-2"> Sign Up</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-success mx-2">Log Out</button>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col">
            <div class="jumbotron jumbotron-fluid">
                <h1 class="display-4">Hello, world!</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </div>
        </div>
    </div>
</div>
@endsection()