<div class="main-gallery-section my-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="video-wrapper">
                    <div class="row g-2">
                        @foreach ($videos as $video)
                            <div class="col-sm-6">
                                <a href="{{ @$video->data_values->youtube_link }}" class="video-item">
                                    <div class="video-item__thumb">
                                        <img src="{{ frontendImage('video', @$video->data_values->image) }}" alt="video gallery">
                                    </div>
                                    <span class="play-icon">
                                        <i class="las la-play"></i>
                                    </span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if ($videos->hasPages())
            <div class="mt-5">
                {{ paginateLinks($videos) }}
            </div>
        @endif
    </div>
</div>
