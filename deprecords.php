<?php
$a=$_POST['dropdown'];
  $obj=mysql_connect("localhost","root","");
    mysql_select_db("sulochana",$obj);
    echo '<body style="background-color:#00bfff">';
  /*
  02 ? Electrical & Electronics Engineering
03 ? Mechanical Engineering
04 ? Electronics & Communication Engineering
05 ? Computer Science & Engineering
12 – Information Technology
  */
  if($a=='CSE')
    $d='A05';
  else if($a=='IT')
    $d='A12';
else if($a=='ECE')
    $d='A04';
else if($a=='EEE')
    $d='A02';
else
    $d='A03';
$v2=mysql_query("SELECT substr(Subcode,1,2),count(Substr(Subcode,1,2)) FROM `batch_2014` group by substr(Subcode,1,2) order by count(Substr(Subcode,1,2)) DESC limit 1");
while($v12=mysql_fetch_array($v2))
    $sy=$v12['substr(Subcode,1,2)'];


$sq=mysql_query("select count(distinct Subname) from batch_2014 where Htno like '%$d%' and Subcode like '%$sy%'");
while($row2=mysql_fetch_array($sq))
{
    $tar=$row2['count(distinct Subname)'];
}

$b=mysql_query("select *,count(Htno) from batch_2014 where Htno LIKE '%$d%' and Subcode like '%$sy%' group by Htno ");  // string LIKE '%inner_string to be matched%'
if(mysql_num_rows($b))
{
    echo "<center><table border=\"2\" cellpadding=\"3\" cellspacing=\"5\"
        style=\"border-collapse: separate\" bordercolor=\"#808080\" width=\"75%\" bgcolor=\"#COCOCO\">
        <caption><font size=\"20%\">*******$a RECORDS*******</font></caption><thead>
        <th>  Htno  </th>
        <th>Subcode</th>
        <th>Subname</th>
        <th>Internal</th>
        <th>External</th>
        <th>Credits</th>
        <th>Year</th>
        <th>Sem</th></thead>";
    while($row=mysql_fetch_array($b))
    {
        if($row['count(Htno)']==$tar)
        {
            $s=$row['Htno'];
            $c=mysql_query("select * from batch_2014 where Htno='$s'");
            while($c1=mysql_fetch_array($c))
                echo "<tr>   <td width=8.80%>".$c1['Htno']."</td>
                    <td >".$c1['Subcode']."</td><td >".$c1['Subname']."</td><td>".$c1['Internal']."</td><td>".$c1['External']."</td>
                    <td>".$c1['credits']."</td><td>".$c1['Year']."</td><td>".$c1['Sem']."</td></tr>";
        }
    }
    echo "</table>";
}
else
    echo "No Data";

 ?>
