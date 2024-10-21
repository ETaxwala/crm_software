@include('ui.header')

<style>
    .card {
        margin: 1em auto;
    }

    .card-title,
    .card-text {
        color: white !important;
    }
</style>
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>Services Videos</h6>
                </div>
                <div class="ms-panel-body">
                    <div class="row">
                        @for ($i = 0; $i < 7; $i++)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="card" style="max-width: 24rem;">
                                    <iframe class="card-img-top"
                                        src="https://www.youtube.com/embed/5WJ-Afzz8NU?si=KlyH69JkxRzQ6z_l"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen controls></iframe>


                                    <div class="card-body bg-dark">
                                        <h5 class="card-title">ITR</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make
                                            up
                                            the bulk of the card's content.</p>
                                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('ui.footer')
