
    var tag = document.createElement('script');

    tag.src = 'https://www.youtube.com/iframe_api';
    document.getElementsByTagName('script')[0].parentNode.insertBefore(tag, document.getElementsByTagName('script')[0]);

    var youtubeVideos = [];

    function onYouTubeIframeAPIReady() {
        $('.youtube-video').each(function() {
            youtubeVideos.push(new YT.Player($(this).attr('id'), {
                height: '100%',
                width: '100%',
                playerVars: {
                    autoplay: 1,
                    loop: 1,
                    controls: 0,
                    showinfo: 0,
                    autohide: 1,
                    modestbranding: 1,
                    vq: 'hd1080'
                },
                videoId: $(this).data('video'),
                events: {
                    'onReady': onPlayerReady
                }
            }));
        });
    }

    function onPlayerReady(event) {
            event.target.playVideo();
            event.target.mute();
    }

