<div class="play" style="background-image:url({{ img_backdrop($backdrop, 'original') }})">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div style="height:6em"></div>
                    <div id="player" style="height: 100%">
                        <div class="embed-responsive embed-responsive-16by9">
                            <video id="play-video" class="embed-responsive-item video-js vjs-16-9 vjs-big-play-centered" controls="" preload="none" width="600" height="315" poster="{{ img_backdrop($backdrop) }}" data-setup="" webkit-playsinline="true" playsinline="true">
                                <source src="{{ $video }}" type="video/mp4" label="SD">
                                <source src="{{ $video }}" type="video/mp4" label="HD">
                                <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to the latest web browser</p>
                            </video>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>