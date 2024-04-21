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
        updateVolumeProgressBar(audioElement.audio);

        $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
            e.preventDefault();
        });

        $(".playbackBar .progressBar").mousedown(function(e) {
            mouseDown = true;
            timeFromOffset(e, this);
        });

        $(".playbackBar .progressBar").mousemove(function(e) {
            if (mouseDown) {
                timeFromOffset(e, this);
            }
        });

        $(".volumeBar .progressBar").mousedown(function() {
            mouseDown = true;
        });

        $(".volumeBar .progressBar").mousemove(function(e) {
            if (mouseDown) {
                var percentage = e.offsetX /  $(this).width();
                if (percentage >= 0 && percentage <= 1) {
                    audioElement.audio.volume = percentage;
                }
            }
        });

        $(document).mouseup(function() {
            mouseDown = false;
        });
    });

    function timeFromOffset(mouse, progressBar) {
        var percentage = mouse.offsetX / $(progressBar).width() * 100;
        var seconds = audioElement.audio.duration * (percentage / 100);
        audioElement.setTime(seconds);
    }

    function prevSong() {
        if (audioElement.audio.currentTime >= 3 || currentIndex == 0) {
            audioElement.setTime(0);
        } else {
            currentIndex = currentIndex - 1;
            setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
        }
    }

    function nextSong() {
        if (repeat == true) {
            audioElement.setTime(0);
            //playSong();
            return;
        }
        if (currentIndex == currentPlaylist.length - 1) {
            currentIndex = 0;
        } else {
            currentIndex++;
        }

        var trackToPlay = currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, true);
    }

    function setRepeat() {
        repeat = !repeat;

        var image =  repeat ? "repeat-active.png" : "repeat.png";
        $(".controlButton.repeat img").attr("src", "assets/images/icons/" + image);
    }

    function setMute() {
        audioElement.audio.muted = !audioElement.audio.muted;

        var image =  audioElement.audio.muted ? "muted.png" : "volume.png";
        $(".controlButton.volume img").attr("src", "assets/images/icons/" + image);
    }

    function setShuffle() {
        shuffle = !shuffle;

        var image =  shuffle ? "shuffle-active.png" : "shuffle.png";
        $(".controlButton.shuffle img").attr("src", "assets/images/icons/" + image);
    
        if (shuffle) {
            shuffleArray(shufflePlaylist);
        } else {

        }
    }

    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    function setTrack(trackId, newPlaylist, play) {

        if (newPlaylist != currentPlaylist) {
            currentPlayList = newPlaylist;
            shufflePlaylist = currentPlaylist.slice();
            shuffleArray(shufflePlaylist);
        }

        if (shuffle == true) {
            currentIndex = shufflePlaylist.indexOf(trackId);
        } else {
            currentIndex = currentPlaylist.indexOf(trackId);
        }

        $.post("includes/handlers/ajax/getSongjson.php", {songId: trackId}, function(data) {

            
            //pauseSong();

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

                    <button class = "controlButton shuffle" title = "Shuffle button" onclick = "setShuffle()">
                        <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                    </button>

                    <button class = "controlButton previous" title = "Previous button" onclick = "prevSong()">
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

                    <button class = "controlButton next" title = "Next button" onclick = "nextSong()">
                        <img src="assets/images/icons/next.png" alt="Next song">
                    </button>

                    <button class = "controlButton repeat" title = "Repeat button" onclick = "setRepeat()">
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
                <button class = "controlButton volume" title = "Volume button" onclick = "setMute()">
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