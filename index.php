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
    <div id = "nowPlayingBarContainer">
    
        <div id = "nowPlayingBar">
            
            <div id = "nowPlayingLeft">


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
                </div>

            </div>

            <div id = "nowPlayingRight">
                

            </div>
        </div>

    </div>

</body>
</html>