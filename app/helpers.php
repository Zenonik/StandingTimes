<?php
function colors($id){
    if ($id <= 5){
        return "lightblue";
    }
    elseif ($id <= 10){
        return "lightgreen";
    }
    elseif ($id >= 10){
        return "gold";
    }
}
?>
