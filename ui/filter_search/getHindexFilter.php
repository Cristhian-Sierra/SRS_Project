<?php
if(isset($_POST['hindex_range'])){
    
    //Include database configuration file
    include('../persistence/Connection.php');
    
    //set conditions for filter by price range
    $whereSQL = $orderSQL = '';
    $hindexRange = $_POST['hindex_range'];
    if(!empty($hindexRange)){
        $hindexRangeArr = explode(',', $hindexRange);
        $whereSQL = "WHERE hindex BETWEEN '".$hindexRangeArr[0]."' AND '".$hindexRangeArr[1]."'";
        $orderSQL = " ORDER BY hindex ASC ";
    }
    
    //get product rows
    $query = $db->query("SELECT journal.hindex FROM journal $whereSQL $orderSQL");
    
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
    ?>
            <div class="list-item">
                <h2><?php echo $row["name"]; ?></h2>
                <h4>Price: <?php echo $row["price"]; ?></h4>
            </div>
    <?php }
    }else{
        echo 'Product(s) not found';
    }
}
?>