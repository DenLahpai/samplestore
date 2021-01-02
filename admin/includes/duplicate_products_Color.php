<?php
require_once "../functions.php";
if (isset($_REQUEST)) {
    $db = new Database();
    
    //getting data to be duplicated
    $rows_Products = table_Products ('select_by_link', NULL, NULL, NULL, NULL, NULL, NULL);
    foreach ($rows_Products as $row_Products) {
        # Code...
    }
    
    //checking for products with size and color
    $stm = "SELECT * FROM Products WHERE 
        ProductsCode = :ProductsCode AND
        Size = :Size AND
        Color = :Color
    ;";
    $db->query($stm);
    $db->bind(":ProductsCode", $row_Products->ProductsCode);
    $db->bind(":Size", $row_Products->Size);
    $db->bind(':Color', $_REQUEST['new_value']);
    $rowCount = $db->rowCount();

    if ($rowCount == 0 ) {
        $stm = "INSERT INTO Products SET
            ProductsLink = :ProductsLink, 
            ProductsCode = :ProductsCode, 
            BrandsId = :BrandsId, 
            Name = :Name,
            Cat1 = :Cat1,
            TargetsId = :TargetsId,
            Size = :Size, 
            Color = :Color,
            Price = :Price, 
            Discount = :Discount, 
            Description = :Description, 
            Status = :Status,
            UsersId = :UsersId           
        ;";
        $db->query($stm);
        $db->bind(":ProductsLink", uniqid("Prd_", true));
        $db->bind(":ProductsCode", $row_Products->ProductsCode);
        $db->bind(":BrandsId", $row_Products->BrandsId);
        $db->bind(":Name", $row_Products->Name);
        $db->bind(":Cat1", $row_Products->Cat1);
        $db->bind(":TargetsId", $row_Products->TargetsId);
        $db->bind(":Size", $row_Products->Size);
        $db->bind(":Color", $_REQUEST['new_value']);
        $db->bind(":Price", $row_Products->Price);
        $db->bind(":Discount", $row_Products->Discount);
        $db->bind(":Description", $row_Products->Description);
        $db->bind(":Status", $row_Products->Status);
        $db->bind(":UsersId", $_SESSION['Id']);
        
        if ($db->execute()) {
            $i = true;
        }
        else {
            echo "<span style='color: red;'>There was a connection error! Please try again!</span>";
        }        
    }
    else {
        echo "<span style='color: red;'>Duplicate entry!</span>";
    }
}   
?>