<?php
	include("config.php");

	if(isset($_GET['page'])) $page = ($_GET['page'] - 1); else $page = 0;
	if(isset($_GET['cat'])) $cat = ($_GET['cat']); else $cat = 0;
	if(isset($_GET['term'])) $term = ($_GET['term']); else $term = '';
	if(isset($_GET['tag'])) $tag = ($_GET['tag']); else $tag = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>3B Data Security - News & Features</title>
<!-- Stylesheets -->
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<!-- Responsive File -->
<link href="assets/css/responsive.css" rel="stylesheet">
<!-- Color File -->
<link href="assets/css/color-4.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

<!-- Style of the plugin -->
<link rel="stylesheet" href="plugin/whatsapp-chat-support.css">
<link rel="stylesheet" href="plugin/components/Font Awesome/css/font-awesome.min.css">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>
<style type="text/css">
@media only screen and (min-width: 900px) {
	.blogimg {height: 100%;}
}
</style>
<body>
<div class="page-wrapper">
	<?php include("includes/home_menu.php");?>
    
    <!-- Page Banner Section -->
    <section class="page-banner">
        <div class="image-layer lazy-image" data-bg="url('assets/images/background/image-11.jpg')"></div>
        <div class="bottom-rotten-curve alternate"></div>
        <div class="auto-container">
            <h1>Latest News</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.php">Home</a></li>
                <li><a href="3B-Data-Security-Blog.php">Latest News</a></li>
            </ul>
        </div>
    </section>
    <!--End Banner Section -->

    <!-- News Section -->
    <section class="news-section">
        <div class="auto-container">
            <div class="row">
			<?php
				$and = true;
				$rw = 0;
				$records_per_page = 9;
				$pagination = new Zebra_Pagination();

				// fetch the total number of records in the table
				
				$sql = "select t.tagid, t.tagname, tl.tag_id, b.id, b.title, b.image, b.datetime, b.intro, b.id as blogid, b.cat, catid, category from articles b, categories, tags t left join tags_lookup tl on t.tagid = tl.tag_id where categories.catid = b.cat"; 

				if($tag > 0) {$sql .=" and t.tagid = ".$tag." and tl.tag_id = t.tagid and b.id = tl.articles_id"; }
				if($cat > 0) {$sql .=" and b.cat = '".$cat."'";}
				if($term != '')	{
					$words = explode(' ',$term);
					if(count($words) > 1) {
						if($and) $ssql = " and "; else $ssql = "";
						    foreach($words as $word => $value) {
							    $ssql .= " (title like '%".$value."%' OR intro like '%".$value."%' OR content like '%".$value."%') OR ";
						    }
						    $ssql = substr($ssql,0,strlen($ssql)-3);
						    $sql .= $ssql;
					    } else {
						if($and) 
							$sql .= " amd (title like '%".$term."%' OR intro like '%".$term."%' OR content like '%".$term."%')";#
						else
							$sql .= " where (title like '%".$term."%' OR intro like '%".$term."%' OR content like '%".$term."%')";#
					}
					$and = true;
				}
				$sql .= " group by b.id";
				$rows = $db->query($sql);
				if($rows) {
					$rowcount = $rows->num_rows;
				    $and = true;
				    $sql = "select t.tagid, t.tagname, tl.tag_id, b.id, b.title, b.image, b.datetime, b.intro, b.id as blogid, b.cat, catid, category from articles b, categories, tags t left join tags_lookup tl on t.tagid = tl.tag_id where categories.catid = b.cat";
				    if($cat > 0) {
					    $sql.=" and b.cat = '".$cat."'";
					    $and = true;
				    }
				    if($tag > 0) {
					    if($and) {
						    $sql .=" and t.tagid = ".$tag." and tl.tag_id = t.tagid and b.id = tl.articles_id";
						    $and = true;
					    } else {
						    $sql .=" t.tagid = ".$tag." and tl.tag_id = t.tagid and b.id = tl.articles_id"; 
						    $and = true;
					    }
				    }
				    if($term != '') {
					    $words = explode(' ',$term);
					    if(count($words) > 1) {
					        if($and) {
							    $ssql = " and ";
						} else {
							$ssql = "";
						}
						foreach($words as $word => $value) {
							$ssql .= " (title like '%".$value."%' OR intro like '%".$value."%' OR content like '%".$value."%') OR ";
						}
						$ssql = substr($ssql,0,strlen($ssql)-3);
						$sql .= $ssql;
					} else $sql .= "  and (title like '%".$term."%' OR intro like '%".$term."%' OR content like '%".$term."%')";
				}
				$sql .= ' group by b.id order by datetime desc limit ' . ($page * $records_per_page) . ','.$records_per_page;
				$rows = $db->query($sql);
				
				// pass the total number of records to the pagination class
				$pagination->records($rowcount);
				
				// records per page
				$pagination->records_per_page($records_per_page);
				if(!empty($rows)) {

				while($row = $rows->fetch_assoc())			
				{
				
				?>
                <!-- News Block One -->
                <div class="news-block-one col-lg-4">
                    <div class="inner-box">
                        <div class="image" style="height:300px;background-size:cover;"><a href="/blog/<?=seo_url($row['title'])?>/<?=$row['blogid']?>"><img class="lazy-image owl-lazy blogimg" src="/uploads/<?=$row['image']?>" data-src="/uploads/<?=$row['image']?>" alt=""></a></div>
                        <div class="lower-content">
                            <div class="category"><?=$row['category']?></div>
                            <ul class="post-meta">
                                <li><a href="/blog/<?=seo_url($row['title'])?>/<?=$row['blogid']?>"><i class="far fa-calendar-alt"></i><?=date("jS F Y",$row['datetime'])?></a></li>
                                <li><a href="/blog/<?=seo_url($row['title'])?>/<?=$row['blogid']?>"><i class="far fa-user"></i>By Admin</a></li>
                            </ul>
							<div style="min-height:200px;">
                            <h3><a href="/blog/<?=seo_url($row['title'])?>/<?=$row['blogid']?>"><?=$row['title']?></a></h3>
                            <div class="text"><?=$row['intro']?></div>
							</div>
						</div>
                    </div>
                </div>

			<?php
				}
			}
			?>

			</div>
    			<?php $pagination->render(); ?>
    			<?php
    				} else echo "<h2>No blogs available as yet.</h2>";
    			?>
            </div>
        </div>
    </section>

	<?php include("includes/3b_footer.php"); ?>

</body>
</html>