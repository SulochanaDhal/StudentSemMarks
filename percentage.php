<?php
$a=$_POST['dropdown'];
  $obj=mysql_connect("localhost","root","");
    mysql_select_db("sulochana",$obj);
    echo '<body style="background-color:#00bfff">';
if($a=='CSE')
   $d='A05';
else if($a=='IT')
   $d='A12';
else if($a=='ECE')
    $d='A04';
else if($a=='EEE')
    $d='A02';
else
    if($a=='MECH')
    $d='A03';

$v2=mysql_query("SELECT substr(Subcode,1,2),count(Substr(Subcode,1,2)) FROM `batch_2014` group by substr(Subcode,1,2) order by count(Substr(Subcode,1,2)) DESC limit 1");
while($v12=mysql_fetch_array($v2))
    $sy=$v12['substr(Subcode,1,2)'];

$sq=mysql_query("select count(distinct Subname) from batch_2014 where Htno like '%$d%' and Subcode like '%$sy%'");
while($row2=mysql_fetch_array($sq))
{
    $tar=$row2['count(distinct Subname)'];
}

$count=$pass=0;
$r=mysql_query("select distinct Htno from batch_2014 where Htno LIKE '%$d%' and Subcode LIKE '%$sy%' ");
while($row=mysql_fetch_array($r))
{
    $c=0; $c1=0;
    $i=$row['Htno'];
    $t=mysql_query("select credits from batch_2014 where Htno LIKE '%$i%' and Subcode LIKE '%$sy%'  ");
    while($row1=mysql_fetch_array($t))
    {
        if($row1['credits']!=0)
            $c++;
        $c1++;
    }
    if($c1==$tar)
    {
        if($c==$tar)
            $pass++;
        $count++;
    }
}
    echo "<strong><center><font size='25%'>STUDENTS APPEARED:<font color=\"#dc143c\">$count</font><br><br>STUDENTS WHO HAVE PASSED OUT:<font color=\"#dc143c\">$pass</font>";
    $per=round(($pass/$count)*100,2);
    echo "<center><h3>$a PASS PERCENTAGE IS</h3>";
    echo "<strong><font color=\"dc143c\">$per";

 ?>
