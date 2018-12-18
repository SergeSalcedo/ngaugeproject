<?php
    $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
    
    $gamesearch = $db->prepare("SELECT * FROM game WHERE G_Name LIKE '%".$_POST['search']."%'");
    $gamesearch->execute();
    
    if($gamesearch->rowCount() > 0){
        $output .= '<div class="table-responsive">
                        <table class="table-responsive">
                            <table class = "table table bordered">
                                <tr>
                                    <th>Game Name</th>
                                    <th>Developer</th>
                                    <th>Publisher</th>
                                    <th>Genre</th>
                                    <th>Release</th>
                                </tr>';
        while($fetch = $gamesearch->fetch(PDO::FETCH_ASSOC)){
            $output .= '
                <tr>
                    <td>'.$row["G_Name"].'</td>
                    <td>'.$row["G_Developer"].'</td>
                    <td>'.$row["G_Publisher"].'</td>
                    <td>'.$row["G_Genre"].'</td>
                    <td>'.$row["G_Release"].'</td>
                </tr>
            ';
        }
        echo $output;
    }
    else{
        echo "Game not found!";
    }
?>