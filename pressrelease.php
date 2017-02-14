<?php
include "header.php";

function pagination($query,$per_page=10,$page=1,$url=''){   
    //global $conDB; 
    $query = "SELECT COUNT(*) as `num` FROM {$query}";
    $row = mysql_fetch_array(mysql_query($query));
    $total = $row['num'];
    $adjacents = "2"; 
      
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $lastlabel = "Last &rsaquo;&rsaquo;";
      
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
      
    $prev = $page - 1;                          
    $next = $page + 1;
      
    $lastpage = ceil($total/$per_page);
      
    $lpm1 = $lastpage - 1; // //last page minus 1
      
    $pagination = "";
    if($lastpage > 1){   
        $pagination .= "<ul class='pagination'>";
        //$pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
              
            if ($page > 1) $pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";
              
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li><a class='current'>{$counter}</a></li>";
                else
                    $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
            }
          
        } elseif($lastpage > 5 + ($adjacents * 2)){
              
            if($page < 1 + ($adjacents * 2)) {
                  
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>...</li>";
                $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";  
                      
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                  
                $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                $pagination.= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>..</li>";
                $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";      
                  
            } else {
                  
                $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                $pagination.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
            }
        }
          
            if ($page < $counter - 1) {
                $pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
                $pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
            }
          
        $pagination.= "</ul>";        
    }
      
    return $pagination;
}

$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
 
$per_page = 10;
$startpoint = ($page * $per_page) - $per_page;


$statement = "`pressrelease` ORDER BY pressrelease.id DESC";
$retestimonial = mysql_query("SELECT pressrelease.title as pressreleaseTitle, pressrelease.dateposted as pressreleaseDate, pressrelease.url as url, pressrelease.source as source FROM {$statement} LIMIT {$startpoint} , {$per_page}");

if(mysql_num_rows($retestimonial) <= 0){
?>
<div class="container">
    <div class="row text-center">
    	<h1 class="sub-heading" style="  color: #44b749;">Press & Media</h1>

    </div><!-- row --><h2 style="font-size:15px;"><li>For customer support, please contact us at <a href="mailto:support&#64;stopoint&#46;com" title="Stopoint Email">support@stopoint.com</a></li></h2><h2 style="font-size:15px;"><li>For media and analyst inquiries, please contact us at <a href="mailto:pr&#64;stopoint&#46;com" title="Stopoint Email">pr@stopoint.com</a></li></h2>	
    <br />
	<br /> 	
    <div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Sorry!</strong> No Record Found.
  	</div>
</div>
<br />
<br />
<br />
<br />
<?php
}
else{
?>
<!-- slider -->
<div class="container" style="margin-bottom:70px;">

<div class="row text-center">
<h1 class="sub-heading">Press & Media</h1>

</div><!-- row --><h2 style="font-size:15px;"><li>For customer support, please contact us at <a href="mailto:support&#64;stopoint&#46;com" title="Stopoint Email">support@stopoint.com</a></li></h2><h2 style="font-size:15px;"><li>For media and analyst inquiries, please contact us at <a href="mailto:pr&#64;stopoint&#46;com" title="Stopoint Email">pr@stopoint.com</a></li></h2>
<br />
<br />
<div id="content" class="content">
<style type="text/css">
ul.pagination {
    text-align:center;
    color:#829994;
}
ul.pagination li {
    display:inline;
    padding:0 3px;
}
ul.pagination a {
    color:#0d7963;
    display:inline-block;
    padding:5px 10px;
    border:1px solid #cde0dc;
    text-decoration:none;
}
ul.pagination a:hover, 
ul.pagination a.current {
    background:#0d7963;
    color:#fff; 
}
</style>
<?php
while ($wetestimonial = mysql_fetch_assoc($retestimonial)){
	
?>
<div class="col-lg-12">
	
	<div class="testimonialcontents col-lg-11">
        <p style="text-align:justify;">
        <b><?php echo date('F d,Y', strtotime($wetestimonial['pressreleaseDate']));?></b> | <?=$wetestimonial['source']?><br /><a href="<?php echo $wetestimonial['url'] ?>" target="_blank"><?=$wetestimonial['pressreleaseTitle']?></a></p>
        
    </div>
</div>
<br />
<br />
<br />
<br />

<?php
}

echo pagination($statement,$per_page,$page,$url='https://www.stopoint.com/pressrelease.php?&amp;');

?>
</div>
</div><!-- end container --> 
<!-- end slider -->
<?php
}
include "footer.php";
?>