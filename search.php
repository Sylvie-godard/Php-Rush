<?php
 
function searchQ(){
    if(isset($_GET['q']) && !empty($_GET['q'])){
        $q = htmlspecialchars($_GET['q']);
        $sql = "SELECT * FROM products WHERE name LIKE %.'$q'.% ORDER BY ASC";
        $search = $bdd->query($sql);

        if($search->rowCount() == 0){
            echo "No product found for: $q.\n";
        }
    }
}

?>

<form method="GET">
    <input type="search" name="q" placeholder="Search...">
    <input type="submit" value="Go">
</form>