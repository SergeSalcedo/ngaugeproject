<?php

    $host ="127.0.0.1";
        $user = "amaterixen";
        $pass="";
        $db = "ngauge";
        $port = 3306;
        
        $connection = mysqli_connect($host,$user,$pass,$db,$port)or die(mysql_error());
    
    include ("db_connector.php");
    
    $gamesearch = $db->prepare("SELECT * FROM game WHERE G_Name = '".$_POST['Search']."'");
    $gamesearch->execute();
    
    
    /*if(!isset($_POST['search']))
    {
        header("Location:index.php");
        $query = "SELECT * FROM game WHERE G_Name LIKE '%".$_POST['search']."%'";
        $result = mysqli_query($connection, $query);
    
        if(mysqli_num_rows($result)!= 0)
        {
        
            $search_rs = mysql_fetch_assoc();
        }
    }
    
    
    
    //$search_sql = "SELECT * FROM game WHERE G_Name LIKE '%".$_POST['search']."%' OR description LIKE '%".$_POST['search']."%'";
    //$query = mysqli_query($connection, $search_sql);
    //$query = "SELECT * FROM game WHERE G_Name LIKE '%".$_POST['search']."%' OR description LIKE '%".$_POST['search']."%'";
    
    
?>

<p> Search results </p>
<?php 
    if(mysqli_num_rows($query)!=0)
    {
        do
        {?>
            <p><?php echo $search_rs['']; ?></p>
        <?php
        }
            while($search_rs = mysqli_fetch_assoc($query));
        }
          else 
        {
           // echo "no results found";
        }*/
?> 