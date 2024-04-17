<?php 
include("includes/config.php");

//session_destroy(); LOGOUT MANUALLY

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musify</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

    <div id = "mainContainer">

        <div id = "topContainer">
            
            <div id = "navbarContainer">
                <nav class = "navBar">
                    <a href="index.php" class = "logo">
                        <img src="assets/images/icons/logo.png" alt="">
                    </a>

                    <div class = "group">
                        <div class = "navItem">
                            <a href="search.php" class = "navItemLink">Search
                                <img src="assets\images\icons\search.png" class = "icon" alt="Search">
                            </a>
                        </div>
                    </div>

                    <div class = "group">
                        <div class = "navItem">
                            <a href="browse.php" class = "navItemLink">Browse</a>
                        </div>
                        <div class = "navItem">
                            <a href="yourMusic.php" class = "navItemLink">Your Music</a>
                        </div>
                        <div class = "navItem">
                            <a href="profile.php" class = "navItemLink">Devansh Tyagi</a>
                        </div>
                    </div>

                </nav>
            </div>
        </div>
    
        <div id = "nowPlayingBarContainer">
        
            <div id = "nowPlayingBar">
                
                <div id = "nowPlayingLeft">
                    <div class = "content">
                    <span class = "albumLink">
                            <img src="assets\images\Minecraft_–_Volume_Alpha.jpeg" class = "albumArtwork" alt="Album artwork">
                    </span> 

                    <div class = "trackInfo">
                            <span class = "trackName">
                                <span>"Song"</span>
                            </span>

                            <span class = "artistName">
                                <span>Devansh Tyagi</span>
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

                            <button class="controlButton play" title="Play button" onclick="togglePlayPause()">
                                <img src="assets/images/icons/play.png" alt="Play">
                            </button>

                            <button class="controlButton pause" title="Pause button" style="display: none;" onclick="togglePlayPause()">
                                <img src="assets/images/icons/pause.png" alt="Pause">
                            </button>

                            <script>
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
    </div>

</body>
</html>