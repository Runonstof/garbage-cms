@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="card-deck">

            <!-- Card Flip card 1 -->
            <div class="card-flip w-50">
                <div class="flip">
                    <div class="front">
                        <!-- front content -->
                        <div class="card">
                            <div class="card-date">
                                <div class="card-date-container card-text-color-contrast">
                                    <div class="card-start-date">
                                        31
                                    </div>
                                    <div class="card-start-month">
                                        Jan
                                    </div>
                                </div>
                            </div>
                            <img class="card-img-top" src="https://i.ytimg.com/vi/5Cy_KvI2nME/maxresdefault.jpg"
                                 alt="#">
                            <div class="card-block">
                                <h4 class="card-title text-bold text-center p-2">Event 1</h4>
                                <p class="card-text lead m-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Aliquam autem, debitis dolores incidunt molestiae similique.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="back">
                        <!-- back content -->
                        <div class="card mb-4">
                            <div class="card-block card-summary">
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur.</p>
                                <a href="#" class="btn btn-success">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-flip w-50">
                <div class="flip">
                    <div class="front">
                        <!-- front content -->
                        <div class="card">
                            <div class="card-date">
                                <div class="card-date-container card-text-color-contrast">
                                    <div class="card-start-date">
                                        31
                                    </div>
                                    <div class="card-start-month">
                                        Jan
                                    </div>
                                </div>
                            </div>
                            <img class="card-img-top" src="https://i.ytimg.com/vi/5Cy_KvI2nME/maxresdefault.jpg"
                                 alt="#">
                            <div class="card-block">
                                <h4 class="card-title text-bold text-center p-2">Event 1</h4>
                                <p class="card-text lead m-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Aliquam autem, debitis dolores incidunt molestiae similique.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="back">
                        <!-- back content -->
                        <div class="card mb-4">
                            <div class="card-block card-summary">
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur.</p>
                                <a href="#" class="btn btn-success">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card Flip -->

        </div>
    </div>
</section>
@endsection