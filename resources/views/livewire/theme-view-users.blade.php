<div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($themes as $theme)
            <div class="col">
                <div class="card">
                    <div id="themeCarousel_{{ $theme->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($theme->picture as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#themeCarousel_{{ $theme->id }}" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#themeCarousel_{{ $theme->id }}" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $theme->name }}</h5>
                        {{-- <p class="card-text">{{ $theme->description }}</p> --}}
                        <button wire:click="useTheme('{{ $theme->id }}')" class="btn btn-primary btn-block">Use</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</div>
