@extends('layouts.app')

@section('content')

        
    <div class="container">
        <!-- Navbar -->
            <nav class="navbar navbar-expand-lg bg-white navbar-dark bd-highlight sticky-top">

            <a class="navbar-brand text-dark" href="#">Doggo News</a>


                <ul class="nav flex-row ml-auto bd-highlight">
                    <li class="nav-item">
                        <a class="nav-link active text-dark" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">World</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Politics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Technology</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Environment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Entertainment</a>
                    </li>
                </ul>

            </nav>
        

        
        <!-- Trending Articles -->
        <div class="jumbotron jumbotron-fluid mb-4 bg-dark" style="background: url(https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80) no-repeat center;">
            <div class="row no-gutters">
            
                <div class="col-6 px-5">
                    <h1 class="display-4 px-5 text-white">Trending</h1>
                </div>
                
                <div class="col-6 px-5" >
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent"><a class="text-light" href='/garbage-cms/doggo/article'>Article Title 1</a></li>
                        <li class="list-group-item bg-transparent"><a class="text-light" href='/garbage-cms/doggo/article'>Article Title 2</a></li>
                        <li class="list-group-item bg-transparent"><a class="text-light" href='/garbage-cms/doggo/article'>Article Title 3</a></li>
                        <li class="list-group-item bg-transparent"><a class="text-light" href='/garbage-cms/doggo/article'>Article Title 4</a></li>
                        <li class="list-group-item bg-transparent"><a class="text-light" href='/garbage-cms/doggo/article'>Article Title 5</a></li>
                    </ul>
                </div>
            </div>
        
        </div>
        
        <!-- Latest Article List-->
        <div class="list-group">

            <!-- Example Article 1 -->
            <li class="list-group-item border-top-0 border-left-0 border-right-0 mb-3">
                <!-- News jumbotron -->
                <div class="jumbotron text-center hoverable p-4 bg-white">
                <div class="row">

                    <!-- Featured Image -->
                    <div class="col-md-4 offset-md-1 mx-3 my-3">
                        <div class="view overlay">
                        <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" class="img-fluid" alt="Sample image for news list">
                        <a>
                            <div class="mask rgba-white-slight"></div>
                        </a>
                        </div>
                    </div>

                    <div class="col-md-7 text-md-left ml-3 mt-3">

                        <!-- News Tag -->
                        <a href="#!" class="green-text">
                        <h6 class="h6 pb-1"><i class="fas fa-desktop"></i>News Tag/Category</h6>
                        </a>

                        <!-- News Title -->
                        <h4 class="h4 mb-4">News Title</h4>

                        <!-- News Excerpt, Author , Publish Date -->
                        <p class="font-weight-normal">Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                        Temporibus ad impedit assumenda quas atque aspernatur nihil libero autem unde dolore! [News Excerpt here]</p>
                        <p class="font-weight-normal">by <a><strong>Author</strong></a>, Date</p>

                        <a class="btn btn-dark text-white" href="/garbage-cms/doggo/article">Read more</a>

                    </div>
                    
                </div>
                </div>
                <!-- News jumbotron -->
            </li>

            <!-- Example Article 2 -->
            <li class="list-group-item border-top-0 border-left-0 border-right-0 mb-3">
                <!-- News jumbotron -->
                <div class="jumbotron text-center hoverable p-4 bg-white">
                <div class="row">

                    <!-- Featured Image -->
                    <div class="col-md-4 offset-md-1 mx-3 my-3">
                        <div class="view overlay">
                        <img src="https://images.unsplash.com/photo-1550502369-d54b8f36db78?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" class="img-fluid" alt="Sample image for news list">
                        <a>
                            <div class="mask rgba-white-slight"></div>
                        </a>
                        </div>
                    </div>

                    <div class="col-md-7 text-md-left ml-3 mt-3">

                        <!-- News Tag -->
                        <a href="#!" class="green-text">
                        <h6 class="h6 pb-1"><i class="fas fa-desktop"></i>News Tag/Category</h6>
                        </a>

                        <!-- News Title -->
                        <h4 class="h4 mb-4">News Title</h4>

                        <!-- News Excerpt, Author , Publish Date -->
                        <p class="font-weight-normal">Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                        Temporibus ad impedit assumenda quas atque aspernatur nihil libero autem unde dolore! [News excerpt here]</p>
                        <p class="font-weight-normal">by <a><strong>Author</strong></a>, Date</p>

                        <a class="btn btn-dark text-white" href="/garbage-cms/doggo/article">Read more</a>

                    </div>

                </div>
                </div>
                <!-- News jumbotron -->
            </li>

        </div>
        </div>

        <!-- Footer -->
        <footer class="page-footer font-small blue">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© 2019. All Rights Reserved.
            </div>
            <!-- Copyright -->

        </footer>
        <!-- Footer -->


@endsection()