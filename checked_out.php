<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'OperationsController.php';
        $ops = new OperationsController();
        $user_book = $ops->getCheckedOut();
        echo "<h1 align=center>Checked Out Books</h1>";
        if (empty($user_book)){
            echo "<h2 align=center>No Checked Out Books</h2>";
        }else{
            echo "<table align=center cellspacing=0 cellpadding=0 border=1 style=\"border: solid windowtext 1.0pt\"><tr><td align=center>User</td><td align=center>Book</td></tr>";
            for($i=0; $i<count($user_book); $i=$i+2){
                echo "<tr><td align=center>{$user_book[$i]}</td>";
                echo "<td align=center>{$user_book[$i+1]}</td></tr>";
            }
            echo "</table>";
        }
        ?>
        <br><p align="center"><a href="main.php">Return to Main Page</a>
    </body>
</html>
