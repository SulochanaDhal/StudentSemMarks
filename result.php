<?php
$a=$_POST['hltn'];
  $obj=mysql_connect("localhost","root","");
    mysql_select_db("sulochana",$obj);
    $b=mysql_query("select * from batch_2014 where Htno='$a'");
    echo '<body style="background-color:#00bfff">';
    if(mysql_num_rows($b))
    {

        echo "<center><table border=\"2\" cellpadding=\"3\" cellspacing=\"5\" style=\"border-collapse: separate\" bordercolor=\"#808080\" width=\"75%\" bgcolor=\"#COCOCO\"><caption><font size=\"20%\">******ALL THE BEST*******</font></caption><thead>
            <th>  Htno  </th>
            <th>Subcode</th>
        <th>Subname</th>
        <th>Internal</th>
        <th>External</th>
        <th>Credits</th>
        <th>Year</th>
        <th>Sem</th></thead>
        ";
        while($row=mysql_fetch_array($b))
        {
            echo "<tr>   <td width=8.80%>".$row['Htno']."</td>
                    <td >".$row['Subcode']."</td>
                   <td >".$row['Subname']."</td>
                    <td>".$row['Internal']."</td>
                    <td>".$row['External']."</td>
                     <td>".$row['credits']."</td>
                    <td>".$row['Year']."</td>
                    <td>".$row['Sem']."</td></tr>";
        }
        echo "</table>";
    }
    else
        echo "invalid hallticket number";
 ?>
