<?php
include("includes/includedFiles.php");

if(isset($_GET['term'])) {
    $term = $_GET['term'];
} else {
    $term = "";
}
?>

<div class = "searchContainer">
    <h4>Search for an artist, album or song</h4>
    <input type="text" class= "searchInput" value = " " onfocus = "this.value = this.value">
</div>

<script>
    $(".searchInput").focus();

    $(function() {
        var timer;

        $(".searchInput").keyup(function() {
            clearTimeout(timer);

            timer = setTimeout(() => {
                var val = $(".searchInput").val();
                openPage("search.php?term=" + val);
            }, 2000);
        })
    })
</script>

<div class = "trackListContainer">
    <div class = "borderBottom"></div>
    <h2>Popular</h2>
    
    <ul class = "trackList">
        <?php 
        $songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10");
        
        if (mysqli_num_rows($songsQuery) == 0) {
            echo "<span class = 'noResults'>No songs found matching " . $term ."</span>";
        }

        $songIdArray = array();

        $i = 1;
        while ($row = mysqli_fetch_array($songsQuery)) {
            if ($i > 15) {
                break;
            }

            array_push($songIdArray, $row['id']);

            $albumSong = new Song($con, $row['id']);
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
    <div class = "borderBottom"></div>
</div>