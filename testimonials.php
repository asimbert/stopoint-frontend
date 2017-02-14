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
              
            if ($page > 1) $pagination.= "<li><a href='{$url}/page/{$prev}'>{$prevlabel}</a></li>";
              
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li><a class='current'>{$counter}</a></li>";
                else
                    $pagination.= "<li><a href='{$url}/page/{$counter}'>{$counter}</a></li>";                    
            }
          
        } elseif($lastpage > 5 + ($adjacents * 2)){
              
            if($page < 1 + ($adjacents * 2)) {
                  
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}/page/{$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>...</li>";
                $pagination.= "<li><a href='{$url}/page/{$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}/page/{$lastpage}'>{$lastpage}</a></li>";  
                      
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                  
                $pagination.= "<li><a href='{$url}/page/1'>1</a></li>";
                $pagination.= "<li><a href='{$url}/page/2'>2</a></li>";
                $pagination.= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}/page/{$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>..</li>";
                $pagination.= "<li><a href='{$url}/page/{$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}/page/{$lastpage}'>{$lastpage}</a></li>";      
                  
            } else {
                  
                $pagination.= "<li><a href='{$url}/page/1'>1</a></li>";
                $pagination.= "<li><a href='{$url}/page/2'>2</a></li>";
                $pagination.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}/page/{$counter}'>{$counter}</a></li>";                    
                }
            }
        }
          
            if ($page < $counter - 1) {
                $pagination.= "<li><a href='{$url}/page/{$next}'>{$nextlabel}</a></li>";
                $pagination.= "<li><a href='{$url}/page/$lastpage'>{$lastlabel}</a></li>";
            }
          
        $pagination.= "</ul>";        
    }
      
    return $pagination;
}

$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
 
$per_page = 10;
$startpoint = ($page * $per_page) - $per_page;

if(isset($_GET['recent'])){
$statement = "`testimonial` WHERE testimonial.Contents != 'TEST' ORDER BY testimonial.Date DESC";
$retestimonial = mysql_query("SELECT testimonial.Name as TestimonialTitle, testimonial.Date as TestimonialDate, testimonial.Contents as Contents, testimonial.OrderId as OrderId, testimonial.Rate as Rating, testimonial.UserName as UserName, testimonial.UserCity as City, testimonial.UserState as State, testimonial.ProductId as ProductId FROM {$statement} LIMIT {$startpoint} , {$per_page}");
}
else if(isset($_GET['pos'])){
	
$statement = "`testimonial` WHERE testimonial.Rate BETWEEN 3 AND 5 AND testimonial.Contents != 'TEST' ORDER BY testimonial.Date DESC";
$retestimonial = mysql_query("SELECT testimonial.Name as TestimonialTitle, testimonial.Date as TestimonialDate, testimonial.Contents as Contents, testimonial.OrderId as OrderId, testimonial.Rate as Rating, testimonial.UserName as UserName, testimonial.UserCity as City, testimonial.UserState as State, testimonial.ProductId as ProductId FROM {$statement} LIMIT {$startpoint} , {$per_page}");
}
else if(isset($_GET['neg'])){


$statement = "`testimonial` WHERE testimonial.Rate BETWEEN 0 AND 2.9 AND testimonial.Contents != 'TEST' ORDER BY testimonial.Date DESC";
$retestimonial = mysql_query("SELECT testimonial.Name as TestimonialTitle, testimonial.Date as TestimonialDate, testimonial.Contents as Contents, testimonial.OrderId as OrderId, testimonial.Rate as Rating, testimonial.UserName as UserName, testimonial.UserCity as City, testimonial.UserState as State, testimonial.ProductId as ProductId FROM {$statement} LIMIT {$startpoint} , {$per_page}");
}
else {
$statement = "`testimonial` WHERE testimonial.Contents != 'TEST' ORDER BY testimonial.Date DESC";
$retestimonial = mysql_query("SELECT testimonial.Name as TestimonialTitle, testimonial.Date as TestimonialDate, testimonial.Contents as Contents, testimonial.OrderId as OrderId, testimonial.Rate as Rating, testimonial.UserName as UserName, testimonial.UserCity as City, testimonial.UserState as State, testimonial.ProductId as ProductId FROM {$statement} LIMIT {$startpoint} , {$per_page}");

}
if(mysql_num_rows($retestimonial) <= 0){
?>
<div class="container">
    <div class="row text-center">
    	<h1 class="sub-heading" style="  color: #44b749;">REVIEWS</h1>
<select style="float:right; padding-left:10px; width:200px; height:30px; margin-right:16px; border:1px solid; border-radius:6px;" class="selectpicker" onchange="location = this.options[this.selectedIndex].value;">
    <option value="<?php echo $base_url; ?>/reviews/recent"<?php if(!isset($_GET['pos']) || !isset($_GET['neg'])){?>selected="selected"<?php }?> >MOST RECENT</option>
    <option value="<?php echo $base_url; ?>/reviews/pos"<?php if(isset($_GET['pos'])){?>selected="selected"<?php }?> >POSITIVE REVIEWS</option>
    <option value="<?php echo $base_url; ?>/reviews/neg"<?php if(isset($_GET['neg'])){?>selected="selected"<?php }?> >NEGATIVE REVIEWS</option>
  </select>
    </div><!-- row -->
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
<!--<h1 class="sub-heading">REVIEWS</h1>-->

<!-- TrustBox widget - 0 -->

<div class="trustpilot-widget" data-locale="en-US" data-template-id="539ad60defb9600b94d7df2c" data-businessunit-id="566208860000ff0005865012" data-style-height="500px" data-style-width="100%" data-stars="4,5">
	<a href="https://www.trustpilot.com/review/stopoint.com" target="_blank">Trustpilot</a>
</div>

<!-- End TrustBox widget -->

<div class="button" style="margin-top:40px; margin-bottom:40px; width: 220px"><a href="https://www.trustpilot.com/review/stopoint.com" target="_blank"> View All TrustPilot Review</a></div>
<hr>

<h1 class="sub-heading">Website Reviews</h1>
<select style="float:right; padding-left:10px; width:200px; height:30px; margin-right:16px; border:1px solid; border-radius:6px;" class="selectpicker" onchange="location = this.options[this.selectedIndex].value;">
    <option value="<?php echo $base_url; ?>/reviews/recent"<?php if(!isset($_GET['pos']) || !isset($_GET['neg'])){?>selected="selected"<?php }?> >MOST RECENT</option>
    <option value="<?php echo $base_url; ?>/reviews/pos"<?php if(isset($_GET['pos'])){?>selected="selected"<?php }?> >POSITIVE REVIEWS</option>
    <option value="<?php echo $base_url; ?>/reviews/neg"<?php if(isset($_GET['neg'])){?>selected="selected"<?php }?> >NEGATIVE REVIEWS</option>
  </select>
</div><!-- row -->
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
	$query2 = "SELECT * FROM `product` WHERE ProductCode = '".$wetestimonial['ProductId']."'";
	$requery2 = mysql_query($query2);
	$wequery2 = mysql_fetch_assoc($requery2);
	$unm=explode(" ",$wetestimonial['UserName']);
?>
<div class="band col-lg-12">
	<div class="col-lg-1">
        <img class="img-round" height="100" width="100" src="<?php echo $base_url; ?>/productimages/<?=$wequery2['image_url']?>" alt="Product Image" />
    </div>
	<div class="testimonialcontents col-lg-11">
        <p style="text-align:justify;">
        <input id="kartik" class="rb-rating" data-stars="5" data-step="0.1" data-size="xs" name="rating" value="<?=$wetestimonial['Rating']?>">
        <b><?php echo date('F d,Y', strtotime($wetestimonial['TestimonialDate']));?></b> | <?php  echo ucfirst($unm[0]); 
        //echo $wetestimonial['UserName']?> from <?=$wetestimonial['City']?>, <?=$wetestimonial['State']?><br />Item traded in : <?=$wequery2['Description']?></p>
        <p style="text-align:justify;">"<?=strip_tags($wetestimonial['Contents'])?>"</p>
    </div>
</div>
<br />
<br />
<?php
}
if(isset($_GET['recent'])){
echo pagination($statement,$per_page,$page,$url='https://www.stopoint.com/reviews/recent');
}
elseif(isset($_GET['pos'])){
echo pagination($statement,$per_page,$page,$url='https://www.stopoint.com/reviews/pos'); 
}
elseif(isset($_GET['pos'])){
echo pagination($statement,$per_page,$page,$url='https://www.stopoint.com/reviews/neg');
}
else{
echo pagination($statement,$per_page,$page,$url='https://www.stopoint.com/reviews');
}
?>
</div>
</div><!-- end container --> 
<!-- end slider -->
<?php
}
include "footer.php";
?>

<!-- TrustBox script -->
<script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.sync.bootstrap.min.js" async></script>
<!-- End Trustbox script -->