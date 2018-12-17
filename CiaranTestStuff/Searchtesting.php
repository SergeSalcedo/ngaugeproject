
<html> 

<body>
    <p>search</p>
    <form name="searchTest" method="post" action="searchresults.php">
        <input name="search" type="text" size="100" maxlength="200"/>
        <input name="Submit" type="submit" value="search"/>
        
    </form>
    
    <!-- this below code was added here by mistake moved to result page as i had it set to redirect - ciaran brady-->
    
  <!--  <p> Search results </p> -->
 <?php /* if(mysqli_num_rows($query)!=0)
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
            echo "no results found";
        }
        */?> 
</body>
</html>



