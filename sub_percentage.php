<?php
    $obj = mysql_connect("localhost","root","");
    mysql_select_db("sulochana",$obj);

    echo '<body style="background-color:#00bfff">';
  $a[0]='CSE';
  $a[1]='ECE';
  $a[2]='EEE';
  $a[3]='MECH';
  $a[4]='IT';
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
    else $d='A12';

    echo "<center><table border=\"2\" cellpadding=\"3\" cellspacing=\"5\"
            style=\"border-collapse: separate\" bordercolor=\"#808080\" width=\"85%\" bgcolor=\"#COCOCO\">
            <caption><font size=\"12%\">*******$a[$j] Subject Percentages*******</font>
            <thead>
            <th>Subject</th>
            <th>Total Appeared</th>
            <th>Passed out</th>
            <th>Fail</th>
            <th>Percentage</th>
            <th>TOPPER MARKS</th>
            <th>TOPPER HTNO</th></thead>";

 /*   $sql=mysql_query("select Subname,count(Subname) from batch_2014 where Htno like '%$d%' and Subcode like '%$sy%' group by Subname");
    while($row=mysql_fetch_array($sql))
    {
        $s=$row['Subname'];
        $cnt=$row['count(Subname)'];
        $max=0;$pass=0;
            $cre=mysql_query("select * from batch_2014 where Htno like '%$d%' and Subcode like '%$sy%' and Subname='$s' ");
            while($row1=mysql_fetch_array($cre))
            {
                if($row1['credits']!=0)
                {
                        $top=$row1['Internal']+$row1['External'];
                        if($max<$top)
                        {
                            $max=$top;
                            $hno=$row1['Htno'];
                        }
                    $pass++;
                }

            }
            $fail=$cnt-$pass;
            $per=($pass/$cnt)*100;
            $perc=ceil($per);
            echo "<tr><td>$s</td><td>$cnt</td><td>$pass</td><td>$fail</td><td>$perc</td><td>$max</td><td>$hno</td></tr>";
    }*/
    $v2=mysql_query("SELECT substr(Subcode,1,2),count(Substr(Subcode,1,2)) FROM `batch_2014` group by substr(Subcode,1,2) order by count(Substr(Subcode,1,2)) DESC limit 1");
    while($v12=mysql_fetch_array($v2))
        $sy=$v12['substr(Subcode,1,2)'];

    $sq=mysql_query("select count(distinct Subname) from batch_2014 where Htno like '%$d%' and Subcode like '%$sy%'");
    while($row2=mysql_fetch_array($sq))
    {
        $tar=$row2['count(distinct Subname)'];
    }

    $sql9=mysql_query("select Subname from batch_2014 where Htno like '%$d%' and Subcode like '%$sy%' group by Subname ");
    while($row7=mysql_fetch_array($sql9))
    {
        $s=$row7['Subname'];
        $pass=0;$cnt=0;$max=0;
        $cre=mysql_query("select Htno,count(Htno) from batch_2014 where Htno like '%$d%' group by Htno ");
        while($row8=mysql_fetch_array($cre))
        {
            $hnt=$row8['Htno'];
            if($row8['count(Htno)']==$tar)
            {
                $que=mysql_query("select credits,Internal,External from batch_2014 where Htno='$hnt' and Subcode like '%$sy%' and Subname='$s' ");
                while($row9=mysql_fetch_array($que))
                {
                    if($row9['credits']!=0)
                    {
                        if($max<$row9['Internal']+$row9['External'])
                        {
                            $max=$row9['Internal']+$row9['External'];
                            $hno=$hnt;
                        }
                        $pass++;
                    }
                }
                $cnt++;
            }
        }
        $fail=$cnt-$pass;
        $per=($pass/$cnt)*100;
        $perc=ceil($per);
        echo "<tr><td>$s</td><td>$cnt</td><td>$pass</td><td>$fail</td><td>$perc</td><td>$max</td><td>$hno</td></tr>";
    }
}
?>
