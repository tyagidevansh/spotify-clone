<?php
include("includes/includedFiles.php");

if (isset($_GET['id'])) {
    $artistId = $_GET['id'];
} else {
    header("Location: index.php");
}
$artist = new Artist($con, $artistId);
?>

<div class = "entityInfo">
    <div class = "centerSection">
        <div class = "artistInfo"> 
            <h1 class = "artistName"><?php echo $artist->getName() ?></h1>

            <div class = "headerButtons">
                <button class = "button">Play</button>
            </div>
        </div>
    </div>
</div>

<div class = "trackListContainer">
    <ul class = "trackList">
        <?php 
        $songIdArray = $artist->getSongIds();

        $i = 1;
        foreach($songIdArray as $songId) {
            $albumSong = new Song($con, $songId);
            $albumArtist = $albumSong->getArtist();
            echo "<li class = 'trackListRow'>
                <div class = 'trackCount'>
                    <img class = 'play' src= 'assets/images/icons/play2.png' onclick = 'setTrack(\"". $albumSong->getId() ."\", tempPlaylist, true)'>
                    <span class = 'trackNumber'>$i</span>
                </div>

                <div class = 'trackInfo'>
                    <span class = 'trackName'>" . $albumSong->getTitle() . "</span>
                    <span class = 'artistName'>" . $albumArtist->getName() . "</span>
                </div>

                <div class = 'trackOptions'>
                    <img class = 'optionsButton' src='assets/images/icons/more.png' alt='more'>
                </div>

                <div class = 'trackDuration'>
                    <span class = 'duration'>". $albumSong->getDuration() ." </span>
                </div>

            </li>";

            
            
            $i++;
        }
        ?>

        <script>
            var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
            console.log(tempPlaylist);
        </script>
    </ul>
</div>