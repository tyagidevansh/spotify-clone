<?php
$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER by RAND() LIMIT 10");

$resultArray = array();

while ($row = mysqli_fetch_array($songQuery)) {
    array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);
?>

<script>
    $(document).ready(function() {
        currentPlaylist = <?php echo $jsonArray?>;
        audioElement = new Audio();
        setTrack(currentPlaylist[0], currentPlaylist, false);
    });

    function setTrack(trackId, newPlaylist, play) {
        $.post("includes/handlers/ajax/getSongjson.php", {songId: trackId}, function(data) {
            var track = JSON.parse(data);
            console.log(track.id);
            
            $(".trackName span").text(track.title);

            $.post("includes/handlers/ajax/getArtistjson.php", {artistId: track.artist}, function(data) {
                var artist = JSON.parse(data);
                $(".artistName span").text(artist.name);
            });

            $.post("includes/handlers/ajax/getAlbumjson.php", {albumId: track.album}, function(data) {
                var album = JSON.parse(data);
                $(".albumLink img").attr("src", album.artworkPath);
            });

            audioElement.setTrack(track);
            audioElement.currentlyPlaying = track;
        });
        
        if (play) {
            audioElement.audio.play();
        }
    }

    function playSong() {

        if (audioElement.audio.currentTime == 0) {
            $.post("includes/handlers/ajax/updatePlays.php", {songId: audioElement.currentlyPlaying.id});
        }
        togglePlayPause();
        audioElement.play();
    }

    function pauseSong() {
        togglePlayPause();
        audioElement.pause();
    }

    function togglePlayPause() {
        var playButton = document.querySelector('.controlButton.play');
        var pauseButton = document.querySelector('.controlButton.pause');

        if (playButton.style.display !== 'none') {
            playButton.style.display = 'none';
            pauseButton.style.display = 'inline-block';
        } else {
            playButton.style.display = 'inline-block';
            pauseButton.style.display = 'none';
        }
    }
</script>

<div id = "nowPlayingBarContainer">
        
    <div id = "nowPlayingBar">
        
        <div id = "nowPlayingLeft">
            <div class = "content">
            <span class = "albumLink">
                    <img src="" class = "albumArtwork" alt="Album artwork">
            </span> 

            <div class = "trackInfo">
                    <span class = "trackName">
                        <span></span>
                    </span>

                    <span class = "artistName">
                        <span></span>
                    </span>
        
            </div>
            </div>

        </div>

        <div id = "nowPlayingCenter">
            
            <div class = "content playerControls">

                <div class = "buttons" >

                    <button class = "controlButton shuffle" title = "Shuffle button">
                        <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                    </button>

                    <button class = "controlButton previous" title = "Previous button">
                        <img src="assets/images/icons/previous.png" alt="Previous song">
                    </button>

                    <button class="controlButton play" title="Play button" onclick="playSong()">
                        <img src="assets/images/icons/play.png" alt="Play">
                    </button>

                    <button class="controlButton pause" title="Pause button" style="display: none;" onclick="pauseSong()">
                        <img src="assets/images/icons/pause.png" alt="Pause">
                    </button>

                    <script>
                        
                    </script>

                    <button class = "controlButton next" title = "Next button">
                        <img src="assets/images/icons/next.png" alt="Next song">
                    </button>

                    <button class = "controlButton repeat" title = "Repeat button">
                        <img src="assets/images/icons/repeat.png" alt="Repeat">
                    </button>

                </div>

                <div class = "playbackBar">

                        <span class = "progressTime current">0.00</span>

                        <div class = "progressBar">
                            <div class = "progressBarBg">
                                <div class = "progress"></div>
                            </div>
                        </div>

                        <span class = "progressTime remaining">0.00</span>

                </div>
            </div>

        </div>

        <div id = "nowPlayingRight">
            <div class = "volumeBar">
                <button class = "controlButton volume" title = "Volume button">
                    <img src="assets\images\icons\volume.png" alt="Volume">
                </button>

                <div class = "progressBar">
                    <div class = "progressBarBg">
                        <div class = "progress"></div>
                    </div>
                </div>

            </div>
            

        </div>
    </div>

</div>