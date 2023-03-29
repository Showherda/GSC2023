<?php

<db_connection class="php"></db_connection>
$sql = "SELECT * FROM `organization`;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)>0){
    while ($row = mysqli_fetch_assoc($result)) {
        $retrieveLink = $row['blog_link'] . ' ' . $row['donation_link'] . ' ' . $row['link'] . '<br>';
        $scrapeLink = file_get_contents($retrieveLink);
        echo $scrapeLink;
    }
    mysqli_free_result($result);
}

else{
    echo "No links found";
}

?>
