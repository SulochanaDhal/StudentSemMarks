<?php
 $obj = mysql_connect("localhost","root","");
    mysql_select_db("sulochana",$obj);
echo '<body style="background-color:#00bfff">';
$a=$_POST['dropdown'];
$b=$_POST['dropdown1'];
if($a=='CSE')
    $d='A05';
else if($a=='ECE')
    $d='A04';
else if($a=='EEE')
    $d='A02';
else if($a=='MECH')
    $d='A03';
else $d='A12';

$n1=$_POST['txt1'];
$n2=$_POST['txt2'];
/*$v=mysql_query("select Htno,substr(Htno,1,2) from batch_2014");
$arr=array_fill(0,99,'0');
while($v1=mysql_fetch_array($v))
{
    $b1=$v1['substr(Htno,1,2)'];
    $arr[$b1]++;
}
$max1=0;
for($i=0;$i<99;$i++)
{
    if($arr[$i]>$max1)
    {
        $max1=$arr[$i];
        $py=$i;
    }
}*/
$v=mysql_query("SELECT substr(Htno,1,2),count(Substr(Htno,1,2)) FROM `batch_2014` group by substr(Htno,1,2) order by count(Substr(Htno,1,2)) DESC limit 1");
while($v1=mysql_fetch_array($v))
    $py=$v1['substr(Htno,1,2)'];

$v2=mysql_query("SELECT substr(Subcode,1,2),count(Substr(Subcode,1,2)) FROM `batch_2014` group by substr(Subcode,1,2) order by count(Substr(Subcode,1,2)) DESC limit 1");
while($v12=mysql_fetch_array($v2))
    $sy=$v12['substr(Subcode,1,2)'];

echo "<center><table border=\"2\" cellpadding=\"3\" cellspacing=\"5\"
            style=\"border-collapse: separate\" bordercolor=\"#808080\" width=\"70%\" bgcolor=\"#COCOCO\">
            <caption><font size=\"12%\">*******$a-$b Subject Percentages*******</font>
            <thead>
            <th>Subject</th>
            <th>Total Appeared</th>
            <th>Passed out</th>
            <th>Fail</th>
            <th>Percentage</th></thead>";

$ht=mysql_query("select Htno from batch_2014 where Htno like '%$d%' and  substr(Htno,1,2)='$py' and Subcode like '%$sy%' and right(Htno,2)='$n1' order by Htno ASC limit 1");
while($row=mysql_fetch_array($ht))
{
    $hno1=$row['Htno'];
}

if($b!='C')
{    $ht1=mysql_query("select Htno from batch_2014 where Htno like '%$d%' and substr(Htno,1,2)='$py' and Subcode like '%$sy%' and right(Htno,2)='$n2' order by Htno ASC limit 1 ");
    while($row1=mysql_fetch_array($ht1))
    {
        $hno2=$row1['Htno'];
    }
}

if($b=='C')
{
    $n11=mysql_query("select Htno from batch_2014 where Htno like '%$d%'  order by Htno DESC limit 1");
    while($r=mysql_fetch_array($n11))
    {
        $hno2=$r['Htno'];
    }
}

$sq=mysql_query("select count(distinct Subname) from batch_2014 where Htno like '%$d%' and Subcode like '%$sy%'");
while($row2=mysql_fetch_array($sq))
{
    $tar=$row2['count(distinct Subname)'];
}

$top=0;

$sql9=mysql_query("select Subname from batch_2014 where Htno like '%$d%' and Subcode like '%$sy%' group by Subname ");
while($row7=mysql_fetch_array($sql9))
{
    $s=$row7['Subname'];
    $pass3=0;$cnt=0;
    $cre=mysql_query("select Htno,count(Htno) from batch_2014 where Htno like '%$d%' and (Htno between '$hno1' and '$hno2') group by Htno order by Htno ASC");
    while($row8=mysql_fetch_array($cre))
    {
        $hnt=$row8['Htno'];
        if($row8['count(Htno)']==$tar)
        {
            $que=mysql_query("select credits from batch_2014 where Htno='$hnt' and Subcode like '%$sy%' and Subname='$s' ");
            while($row9=mysql_fetch_array($que))
            {
                if($row9['credits']!=0)
                    $pass3++;
            }
            $cnt++;
        }
    }
    if($b=='C')
    {
        $pyc=$py+1;
        $readmit1=mysql_query("SELECT Htno,count(Htno) FROM `batch_2014` WHERE Htno like '%$d%' and (substr(Htno,1,2)!='$py' and substr(Htno,1,2)!='$pyc') group by Htno");
        while($re1=mysql_fetch_array($readmit1))
        {
            $na1=$re1['Htno'];
            if($re1['count(Htno)']==$tar)
            {
                $read1=mysql_query("select credits from batch_2014 where Htno='$na1' and Subcode like '%$sy%' and Subname='$s'");
                while($ree1=mysql_fetch_array($read1))
                {
                    if($ree1['credits']!=0)
                        $pass3++;
                }
                $cnt++;
            }
        }
    }
    $fail=$cnt-$pass3;
    $per1=($pass3/$cnt)*100;
    $perc=round($per1,2);
    echo "<tr><td>$s</td><td>$cnt</td><td>$pass3</td><td>$fail</td><td>$perc</td></tr>";
}
echo "</table>";

$pass=$count=$tot=0;

$sql=mysql_query("select Htno,count(Htno),sum(Internal+External) from batch_2014 where Htno like '%$d%' and Htno between '$hno1' and '$hno2' group by Htno order by Htno ASC");
while($row3=mysql_fetch_array($sql))
{
    $n=$row3['Htno'];
    if($row3['count(Htno)']==$tar)
    {
        $count++;$c=0;
        $q1=mysql_query("select credits from batch_2014 where Htno='$n' and Subcode like '%$sy%'");
        while($qq1=mysql_fetch_array($q1))
        {
            if($qq1['credits']!=0)
                $c++;
        }
        if($c==$tar)
        {
            $pass++;
            if($tot<$row3['sum(Internal+External)'])
            {
                $tot=$row3['sum(Internal+External)'];$top=$n;
            }
        }
    }
}
if($b=='C')
{
    $pyc=$py+1;
    $readmit=mysql_query("SELECT Htno,count(Htno),sum(Internal+External) FROM `batch_2014` WHERE Htno like '%$d%' and (substr(Htno,1,2)!='$py' and substr(Htno,1,2)!='$pyc') and Subcode like '%$sy%' group by Htno");
    while($re=mysql_fetch_array($readmit))
    {
        $h=$re['Htno'];
        if($re['count(Htno)']==$tar)
        {
            $count++;$c=0;
            $q=mysql_query("select credits from batch_2014 where Htno='$h' and Subcode like '%$sy%'");
            while($qq=mysql_fetch_array($q))
            {
                if($qq['credits']!=0)
                    $c++;
            }
            if($c==$tar)
            {
                $pass++;
                if($tot<$re['sum(Internal+External)'])
                {
                    $tot=$re['sum(Internal+External)'];$top=$h;
                }
            }
        }
    }
}
$per=round(($pass/$count)*100,2);
$m=0;

$sss=mysql_query("select distinct Subname from batch_2014 where Htno='$top' and Subcode like '%$sy%' and Subname like '%LAB%' ");
while($ss2=mysql_fetch_array($sss))
    $m++;

$p=0;

$ssq=mysql_query("select * from batch_2014 where Htno='$top' and Subcode like '%$sy%' and Subname like '%SEMINAR%'");
while($l=mysql_fetch_array($ssq))
    $p++;

$top_p=(($tot/(($m*75)+($p*50)+(($tar-$m-$p)*100)))*100);
$top_per=round($top_p,2);
echo "<br><br><br><br><br><center><strong><font size=\"120%\">$a-$b percentage is $per<br>Topper is $top with $top_per%";
?>
