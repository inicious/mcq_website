<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Online Quiz - Quiz List</title>
<link href="../quiz.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php
include("header.php");
include("../database.php");

if(!empty($_REQUEST['rec'])) {
    $limit = $_REQUEST['rec'];
} else {
    $limit=10;
}
if (!empty($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
} else {
    $page = 1;
}
$start_from  = ($page - 1) * $limit;
if(!empty($_REQUEST["sort"]) ){
	$sort_val = $_REQUEST["sort"];
	$sort = "order by score ".$_REQUEST["sort"];
}else{
  $sort_val ="";
	$sort = "order by id ASC";
}
if(!empty($_REQUEST['search'])) {
  $searchValue = $_REQUEST['search'];
     $searchQuery = "WHERE (login like '%".$searchValue."%' or score like '%".$searchValue."%' ) ";
} else {
  $searchValue = "";
    $searchQuery = " ";
}
$sql = "SELECT id,login,user_id,score,test_date from mst_result ".$searchQuery." ".$sort;

$rs_result = mysqli_query($con, $sql." limit " . $start_from . ", " . $limit);	

$page_link=""

?>
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <form id="ticketlisting_form" class="form-horizontal" action="testview.php?rec=<?=$limit?>" method="post">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <input type="text" name="search" class="form-control" placeholder="Search By:User name/ Score" autocomplete="off" value="<?php echo $searchValue;?>" id="search_input">
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" name="submit" class="btn btn-success">Search</button>
                                <button type="button" id="reset_btn" class="btn btn-success">Reset</button>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control" id="record">
                                    <option value="default">No. of Records</option>
                                    <option value="10" <?php if($limit == '10'){echo 'selected';}?>>10</option>
                                    <option value="25" <?php if($limit == '25'){echo 'selected';}?>>25</option>
                                    <option value="50" <?php if($limit == '50'){echo 'selected';}?>>50</option>
                                    <option value="100" <?php if($limit == '100'){echo 'selected';}?>>100</option>
                                    <option value="250" <?php if($limit == '250'){echo 'selected';}?>>250</option>
                                    <option value="500" <?php if($limit == '500'){echo 'selected';}?>>500</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control" id="sort">
                                    <option value="default">Score sort</option>
                                    <option value="ASC" <?php if($sort_val == 'ASC'){echo 'selected';}?>>Score- Low to High</option>
                                    <option value="DESC" <?php if($sort_val == 'DESC'){echo 'selected';}?>>Score- High to Low</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover patnttable " id="ticketTable">
                            <thead class="success">
                                <tr>
                                  <th>id</th>
                                  <th>User name</th>    
                                  <th>score</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($rs_result)) {
                                  
                                ?>
                                <tr id="table-row-<?=$row["id"]?>">
                                    <td><?=$i;?></td>
                                    <td><?=$row['login'];?></td>
                                    <td><?=$row['score'];?></td>  
                                </tr>
                                <?php   
                                    $i++;    
                                    }   
                                ?>
                            </tbody>
                        </table>
                        <ul class="pagination" style="float: right;">
                            <?php
                                $rs_result = mysqli_query($con, $sql);
                                $row_count = mysqli_num_rows($rs_result);
                                if($row_count > 0){
                                $total_records = $row_count;
                                $total_links   = ceil($total_records / $limit);
                                $previous_link = '';
                                $next_link = '';
                                $pagLink       = "";
                                if($total_links > 4)
                                {
                                  $page;
                                  if($page < 5)
                                  {
                                    for($count = 1; $count <= 5; $count++)
                                    {
                                      $page_array[] = $count;
                                    }
                                    $page_array[] = '...';
                                    $page_array[] = $total_links;
                                  }
                                  else
                                  {
                                    $end_limit = $total_links - 5;
                                    if($page > $end_limit)
                                    {
                                      $page_array[] = 1;
                                      $page_array[] = '...';
                                      for($count = $end_limit; $count <= $total_links; $count++)
                                      {
                                        $page_array[] = $count;
                                      }
                                    }
                                    else
                                    {
                                      $page_array[] = 1;
                                      $page_array[] = '...';
                                      for($count = $page - 1; $count <= $page + 1; $count++)
                                      {
                                        $page_array[] = $count;
                                      }
                                      $page_array[] = '...';
                                      $page_array[] = $total_links;
                                    }
                                  }
                                }
                                else
                                {
                                  for($count = 1; $count <= $total_links; $count++)
                                  {
                                    $page_array[] = $count;
                                  }
                                }

                                for($count = 0; $count < count($page_array); $count++)
                                {
                                  if($page == $page_array[$count])
                                  {
                                  
                                    $page_link .= "<li class='active'><a href='testview.php?rec=$limit&page=" . $page_array[$count] . "&search=".$searchValue."'>" . $page_array[$count] . "</a></li>";

                                    $previous_id = $page_array[$count] - 1;
                                    if($previous_id > 0)
                                    {
                                      $previous_link = '<li class="page-item"><a href="testview.php?rec='.$limit.'&page=' . $previous_id . '&search='.$searchValue.'" data-page_number="'.$previous_id.'">Previous</a></li>';
                                    }
                                    else
                                    {
                                      $previous_link = '
                                      <li class="disabled">
                                        <a href="#">Previous</a>
                                      </li>
                                      ';
                                    }
                                    $next_id = $page_array[$count] + 1;
                                    if($next_id >= $total_links)
                                    {
                                      $next_link = '
                                      <li class="disabled">
                                        <a class="page-link" href="#">Next</a>
                                      </li>
                                        ';
                                    }
                                    else
                                    {
                                      $next_link = '<li><a class="page-link"href="testview.php?rec='.$limit.'&page=' . $next_id . '&search='.$searchValue.'" data-page_number="'.$next_id.'">Next</a></li>';
                                    }
                                  }
                                  else
                                  {
                                    if($page_array[$count] == '...')
                                    {
                                      $page_link .= '
                                      <li class="page-item disabled">
                                          <a class="page-link" href="#">...</a>
                                      </li>
                                      ';
                                    }
                                    else
                                    {
                                      $page_link .= "<li ><a href='testview.php?rec=$limit&page=" . $page_array[$count] . "&search=".$searchValue."' data-page_number='".$page_array[$count]."'>" .$page_array[$count] . "</a></li>";
                                    }
                                  }
                                }
                                echo $previous_link.$page_link.$next_link;
                              }

                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
<script type="text/javascript">
$(document).ready(function(){
$('#record').change(function (e) {
        var rec = $(this).val();
        var search = $("#search_input").val();
        var sort = $("#sort").val();
        if(sort == "default"){
        	sort= "";
        }
        window.location.href = 'testview.php?rec=' + rec+'&'+'search='+search+'&'+'sort='+sort;
    });

/*reset form field*/
$("#reset_btn").click(function(event) {
    $('#search_input').val('');
    location.reload(true);
    window.location.href = 'testview.php';
});

$('#sort').change(function (e) {
        var sort = $(this).val();
        var search = $("#search_input").val();
        var rec = $("#record").val();
        window.location.href = 'testview.php?sort=' + sort+'&'+'search='+search+'&'+'rec='+rec;
    });
  
});



</script>
</html>
