<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include ("database.php");
include("header.php");
extract($_POST);
if (!isset($_SESSION['user_id']))
{
    header("location: index.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Online Quiz</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
if (isset($_POST['submit']))
{
    $check_user = mysqli_query($con, "SELECT uesr_id from mst_useranswer where uesr_id='" . $_SESSION['user_id'] . "'");
    if (mysqli_num_rows($check_user) > 0)
    {
        $delect_sql = mysqli_query($con, "DELETE from mst_useranswer where uesr_id='" . $_SESSION['user_id'] . "'") or die(mysqli_error($con));
        $delect_res_sql = mysqli_query($con, "DELETE from mst_result where user_id='" . $_SESSION['user_id'] . "'") or die(mysqli_error($con));
    }
    $array = $_SESSION['q_array'];
    $q_count = count($array['results']);
    $_SESSION['trueans'] = 0;
    for ($i = 0;$i <= $q_count - 1;$i++)
    {
        mysqli_query($con, "insert into mst_useranswer(uesr_id, q_type, que_des, true_ans,your_ans) values ('" . $_SESSION['user_id'] . "', '" . $array['results'][$i]['type'] . "','" . addslashes($array['results'][$i]['question']) . "','" . addslashes($array['results'][$i]['correct_answer']) . "','" . addslashes($_POST["ans" . $i]) . "')") or die(mysqli_error($con));
            $true_ans = $array['results'][$i]['correct_answer'];
        
        if (htmlspecialchars(str_replace(array("'","\"")," ",$_POST["ans" . $i]))== str_replace(array("&apos;","&quot;")," ",$true_ans))
        {
            $_SESSION['trueans'] = $_SESSION['trueans'] + 1;
        }
    }

    echo "<h1 class=head1> Result</h1>";
    echo "<Table align=center><tr class=tot><td>Total Question<td> $q_count";
    echo "<tr class=tans><td>True Answer<td>" . $_SESSION['trueans'];
    $w = $q_count - $_SESSION['trueans'];
    echo "<tr class=fans><td>Wrong Answer<td> " . $w;
    echo "<tr class=fans><td><a href=\"signout.php\">Signout</a>";
    echo "</table>";
    mysqli_query($con, "insert into mst_result(login,user_id,test_date,score) values('".$_SESSION['login']."','" . $_SESSION['user_id'] . "','" . date("Y-m-d") . "','".$_SESSION['trueans']."')") or die(mysqli_error());
    unset($_SESSION['user_id']);
    unset($_SESSION['trueans']);
    exit;
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://opentdb.com/api.php?amount=10',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=f1728636443e6864b65782587efc896d'
    ) ,
));

$response = curl_exec($curl);

$array = json_decode($response, true);
$q_count = count($array['results']);
$_SESSION['q_array'] = $array;
if (empty($q_count))
{
    echo "<h1 class=head1>Some Error  Occured</h1>";
    session_destroy();
    echo "Please <a href=index.php> Start Again</a>";

    exit;
}
//$index= $_SESSION[qn];
echo "<form name=myfm method=post action=quiz.php>";
echo "<table width=100%>";
for ($i = 0;$i <= $q_count - 1;$i++)
{
    $q_no = $i + 1;
    if ($array['results'][$i]['type'] == "boolean")
    {
        echo "<tr> <td width=30>&nbsp;<td> <table border=0>";
        echo "<tR><td><span class=style2>Que " . $q_no . ": " . $array['results'][$i]['question'] . "</style>";
        echo "<tr><td class=style8><input type=radio name=ans" . $i . " value=True required='required'>True";
        echo "<tr><td class=style8> <input type=radio name=ans" . $i . " value=False required='required'>False</table></td></tr>";
    }
    else
    {
        $option_array = array();
        array_push($option_array, $array['results'][$i]['correct_answer'], $array['results'][$i]['incorrect_answers'][0], $array['results'][$i]['incorrect_answers'][1], $array['results'][$i]['incorrect_answers'][2]);
        shuffle($option_array);

        echo "<tr> <td width=30>&nbsp;<td> <table border=0>";
        echo "<tR><td><span class=style2>Que " . $q_no . ": " . $array['results'][$i]['question'] . "</style>";
        echo "<tr><td class=style8><input type=radio name=ans" . $i . " value= '" . $option_array[0] . "' required='required'>" . $option_array[0];
        echo "<tr><td class=style8> <input type=radio name=ans" . $i . " value='" . $option_array[1] . "' required='required'>" . $option_array[1];
        echo "<tr><td class=style8><input type=radio name=ans" . $i . " value='" . $option_array[2] . "' required='required'>" . $option_array[2];
        echo "<tr><td class=style8><input type=radio name=ans" . $i . " value='" . $option_array[3] . "' required='required'>" . $option_array[3] . "</table></td></tr>";
    }

}
echo "<tr> <td width=30>&nbsp;<td> <table border=0><tr><td><input type=submit name=submit value='Get Result'></table></td></tr></form>";
echo "</table>";
?>
</body>
</html>
