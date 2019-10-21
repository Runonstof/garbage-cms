@extends('admin.layouts.app')

@section('content')
        <!-- Navbar -->
        <div class="row nav no-gutters -row">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
                <div class="col-4">
                    <a class="navbar-brand" href="#">
                        <h3 class="my-auto text-left ml-5">LOGO</h3>
                    </a>
                </div>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

                    <ul class="navbar-nav px-4">
                    <li class="nav-item ">
                        <a class="nav-link" href="#">Welcome, User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Header -->
        <div class="row no-gutters my-5">
            <header id="header">
                <div class="col-md-10">
                    <h1 class="my-auto text-left ml-5 pt-5">Dashboard</h1>
                </div>
            </header>
        </div>

        <!-- Side Navbar -->
        <div class="row no-gutters">
            <div class="col-md-2">
                <div class="list-group ml-5 p-3">
                    <a href="#" class="list-group-item list-group-item-action active">
                        Dashboard
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">Posts</a>
                    <a href="#" class="list-group-item list-group-item-action">Users</a>
                    <a href="#" class="list-group-item list-group-item-action">Categories</a>
                    <a href="#" class="list-group-item list-group-item-action">Comments</a>
                </div>
            </div>
            
            <!-- Overview of User -->
            <div class="col-md-10 p-3">
                <div class="card border-light mb-3" >
                    <div class="row no-gutters">
                        <div class="col-sm-12">
                        <div class="card-header">Overview</div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Posts</h5>
                                <p class="card-text">0 new posts</p>
                                <a href="#" class="btn btn-primary">View Posts</a>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Users</h5>
                                <p class="card-text">0 users</p>
                                <a href="#" class="btn btn-primary">View Users</a>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Categories</h5>
                                <p class="card-text">0 categories.</p>
                                <a href="#" class="btn btn-primary">View Categories</a>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Comments</h5>
                                <p class="card-text">0 new comments</p>
                                <a href="#" class="btn btn-primary">View Comments</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Of Latest Posts -->
                <div class="card border-light mb-3">
                <div class="card-header">Latest Posts</div>
                    <div class="row no-gutters">
                        <div class="col-sm-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <th scope="row">1</th>
                                    <td>2019-10-21</td>
                                    <td>First Post</td>
                                    <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quis, consequuntur.</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2</th>
                                    <td>2019-10-21</td>
                                    <td>Second Post</td>
                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, et.</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">3</th>
                                    <td>2019-10-21</td>
                                    <td>Third Post</td>
                                    <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi, dignissimos.</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">4</th>
                                    <td>2019-10-21</td>
                                    <td>Fourth Post</td>
                                    <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quis, consequuntur.</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">5</th>
                                    <td>2019-10-21</td>
                                    <td>Fifth Post</td>
                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, et.</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">6</th>
                                    <td>2019-10-21</td>
                                    <td>Sixth Post</td>
                                    <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi, dignissimos.</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">7</th>
                                    <td>2019-10-21</td>
                                    <td>Seventh Post</td>
                                    <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi, dignissimos.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer bg-dark mt-5 border border-dark" style="width: 100%;">
            <div class="text-center text-light pt-2">
                <h2 class="">FOOTER</h2>
            </div>
        </footer>


@endsection()
