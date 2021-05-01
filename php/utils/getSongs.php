<?php
include("./dbConnection.php");
if (isset($_GET['filter'])) {
    $filterTexts = $_GET['filter'];

    $songsFilterQuery = "SELECT Songs.id, Songs.title title, Singers.name singerName, 
                    Songs.filePath audio, Songs.imgPath img
                    FROM Songs 
                    LEFT JOIN Singers on Singers.id = Songs.singerID
                    WHERE title LIKE '%$filterTexts%' OR Singers.name LIKE '%$filterTexts%'";

    $result = mysqli_query($conn, $songsFilterQuery);
    $songs = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // echo json_encode($songs);

    if (count($songs) > 0) {
        foreach ($songs as $index => $song) {
            echo "<div class='song' data='" . $song['id'] . "'>";
            echo    '<div class="info">';
            echo        "<h4>" . $index + 1 . "</h4>";
            echo        '<img src="' . $song['img'] . '">';
            echo        '<div class="detail">';
            echo            '<h4>' . $song['title'] . '</h4>';
            echo            '<h5>' . $song['singerName'] . '</h5>';
            echo        '</div>';
            echo    '</div>';
            echo     '<div class="func">';
            echo        '<i class="far fa-heart"></i>';
            echo        '<h4>3:01</h4>';
            echo    '</div>';
            echo  '</div>';
        }
    } else {
        echo "<h1>No songs found</h1>";
    }
}