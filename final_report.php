
<?php
    $obj = mysql_connect("localhost","root","");
    mysql_select_db("sulochana",$obj);

    echo '<body style="background-color:#00bfff">';
  $a[0]='CSE';
  $a[1]='ECE';
  $a[2]='EEE';
  $a[3]='MECH';
  $a[4]='IT';
  echo "<center><table border=\"2\" cellpadding=\"3\" cellspacing=\"5\"
            style=\"border-collapse: separate\" bordercolor=\"#808080\" width=\"75%\" bgcolor=\"#COCOCO\">
            <caption><font size=\"20%\">*******College Pass Percentage*******</font>
            <thead>
            <th>Branch</th>
            <th>Total Appeared</th>
            <th>Passed out</th>
            <th>Fail</th>
            <th>Percentage</th></thead>";
    $tot=$pass_total=0;
for($j=0;$j<5;$j++)
{
    if($a[$j]=='CSE')
        $d='A05';
    else if($a[$j]=='ECE')
        $d='A04';
    else if($a[$j]=='EEE')
        $d='A02';
    else if($a[$j]=='MECH')
        $d='A03';
    else
        $d='A12';

    $v2=mysql_query("SELECT substr(Subcode,1,2),count(Substr(Subcode,1,2)) FROM `batch_2014` group by substr(Subcode,1,2) order by count(Substr(Subcode,1,2)) DESC limit 1");
    while($v12=mysql_fetch_array($v2))
        $sy=$v12['substr(Subcode,1,2)'];

    $count=$pass=0;
    $sq=mysql_query("select count(distinct Subname) from batch_2014 where Htno like '%$d%' and Subcode like '%$sy%'");
    while($row2=mysql_fetch_array($sq))
    {
        $tar=$row2['count(distinct Subname)'];
    }

    $r=mysql_query("select htno from batch_2014 where htno like '%$d%' and Subcode like '%$sy%' group by htno");
    while($row=mysql_fetch_array($r))
    {
        $i=$row['htno'];$c=0;$p=0;
        $sql = mysql_query("select credits from batch_2014 where htno like '%$i%' and subcode like '%$sy%'");
        while($row1=mysql_fetch_array($sql))
        {
            if($row1['credits']!=0)
                $c++;
            $p++;
        }

        if($p==$tar)
        {
            if($c==$tar)
                $pass++;
            $count++;
        }
    }

    $tot=$tot+$count;
    $pass_total=$pass_total+$pass;
    $per=($pass/$count)*100;
    $perc=round($per,2);
    $fail=$count-$pass;
    echo "<tr><td>$a[$j]</td><td>$count</td><td>$pass</td><td>$fail</td><td>$perc</td></tr>";
}

    $n='TOTAL';
    $fail_total=$tot-$pass_total;
    $per_total=($pass_total/$tot)*100;
    $perct=round($per_total,2);
    echo "<tr><td>$n</td><td>$tot</td><td>$pass_total</td><td>$fail_total</td><td>$perct</td></tr></table>";
 ?>
