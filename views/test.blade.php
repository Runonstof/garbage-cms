<!-- HTML here -->
@extends('layouts.app')

@section('content')
   
<div class="row nav no-gutters -row">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="col-4">
            <a class="navbar-brand" href="#">
                <h3 class="my-auto text-left ml-5">LOGO</h3>
            </a>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Manage Content</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Create New Project</a>
                        <a class="dropdown-item" href="#">Manage All Projects</a>
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Account Information</a>
                    </div>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn mx-2">Help</button>
                </li>
                <li class="nav-item">
                    <button type="button"  class="btn mx-2">About</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn mx-2"> Log In</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn mx-2"> Sign Up</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn mx-2">Log Out</button>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="row no-gutters my-5">
    <div class="col-11 my-5 mx-auto">
        <div class="jumbotron">
            <h1 class="display-4">Hello, [user] Welcome to Garbage-CMS!</h1>
            <p class="lead">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel voluptate praesentium possimus fuga pariatur sapiente facere dolorem quam a.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn border border-primary btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
</div>

<div class="row no-gutters mb-5">
    <div class="col">
        <div class="row no-gutters">
            <div class="col text-center">
                <h2 class="display-4">FEATURED INFO</h2>
            </div>
        </div>
    </div>
    <div class="col-11 mx-auto">
        <div class="card-group">
            <div class="card">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Feature title</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo, harum ipsam deleniti qui optio adipisci molestiae neque doloremque consequuntur esse quae. Soluta excepturi sequi aut magni rerum voluptatibus molestiae culpa.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Feature title</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi iure facere quae magnam quia sapiente illum ipsum eligendi enim dignissimos iusto voluptates dolorum nesciunt, minima iste excepturi officia rerum. Eius!</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Feature title</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem quisquam magni quo voluptatibus quibusdam porro saepe! Maxime dolor quam nam praesentium laudantium minima cum. Repellendus dolore nobis perspiciatis ullam tempore.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>
</div>


    <footer class="footer bg-dark mt-5 border border-dark" style="width: 100%;">
        <div class="text-center text-light pt-2">
            <h2 class="">FOOTER</h2>
        </div>
    </footer>


@endsection()