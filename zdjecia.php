<?php
    require 'keydb.php';
        $query  = "SELECT img from upload ORDER BY id DESC ";
        if($rezultat = $conn->query($query)){
            while ($row = mysqli_fetch_array($rezultat)) {
            echo "
                    <img src='upload/".$row['img']."'width='500' height='520' style='
                    margin-left: 5%;
                    margin-top: 5%'>";
        }}
        ?>