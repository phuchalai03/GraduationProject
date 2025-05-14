@foreach ($tours as $tour)
    <div class="col-xl-4 col-md-6">
        <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up" data-aos-duration="1500"
            data-aos-offset="50">
            <div class="image">
                {{-- <span class="badge bgc-pink">Featured</span> --}}
                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                <img src="{{ asset('storage/images/' . ($tour->images[0] ?? 'images/default.jpg')) }}" alt="Tour List"
                    style="width: 100%; height: 250px; object-fit: cover; object-position: center; border-radius: 10px;">
            </div>
            <div class="content">
                <div class="destination-header">
                    <span class="location"><i class="fal fa-map-marker-alt"></i>
                        {{ $tour->destination }}</span>
                    <div class="ratting">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($tour->rating && $i < $tour->rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                <h6><a href="{{ route('tour_detail', ['id' => $tour->tourId]) }}">
                        {{ $tour->title }} </a></h6>
                <ul class="blog-meta">
                    <li><i class="far fa-clock"></i> {{ $tour->duration }}</li>
                    <li><i class="far fa-user"></i> {{ $tour->quantity }} guest</li>
                </ul>
                <div class="destination-footer">
                    <span class="price"><span>{{ number_format($tour->priceAdult, 0, ',', '.') }}</span>/Người</span>
                    <a href="{{ route('tour_detail', ['id' => $tour->tourId]) }}"
                        class="theme-btn style-two style-three">
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="col-lg-12">
    <ul class="pagination justify-content-center pt-15 flex-wrap pagination-tours" data-aos="fade-up"
        data-aos-duration="1500" data-aos-offset="50">
        <!-- Previous Page Link -->
        @if ($tours->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link"><i class="far fa-chevron-left"></i></span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $tours->previousPageUrl() }}"><i class="far fa-chevron-left"></i></a>
            </li>
        @endif

        <!-- Page Numbers -->
        @for ($i = 1; $i <= $tours->lastPage(); $i++)
            <li class="page-item @if ($i == $tours->currentPage()) active @endif">
                <a class="page-link" href="{{ $tours->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        <!-- Next Page Link -->
        @if ($tours->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $tours->nextPageUrl() }}"><i class="far fa-chevron-right"></i></a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link"><i class="far fa-chevron-right"></i></span>
            </li>
        @endif
    </ul>
</div>