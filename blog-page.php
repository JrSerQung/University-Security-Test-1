<?php


use App\Blog;
use App\BlogImage;

$blogObj = new Blog;
$blogImageObj = new BlogImage;

$row = $blogObj->getRowByField('seo_url', $slug);

if( !$row ){

	include('404.php');
	exit;

}


$meta_title = 'Get Goods - '.$row->title.' ' ;

require 'header.php';

?>

	<div class="container mb-0 mt-30">
			<div class="col-md-2 hidden-xs hidden-sm" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
			<div class="col-md-8 text-center">  <h1 class="mt-10"><?= $row->title ?></h1> </div>
			<div class="col-md-2" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
	</div>

<div class="container pt-30 pb-30">

					<div class="panel panel-default">
					<div class="panel-heading"><i class="fa fa-comment"></i> <?= $row->title ?> | <em class=""><?= date('d/m/Y', strtotime($row->created_at)) ?></em></div>
						<div class="panel-body">

	<?php $image = $blogImageObj->getAll($row->id); ?>

	<div class="row">
	
		<div class="col-md-8">

						
			<?= $row->content ?>		<br /><br />	
		
		</div>
		
		<div class="col-md-4">
		
			<?php if( isset($image[0]) ){ ?>
		
			<img alt="<?= $image[0]->alt ?>" class="" style="width:100%" src="<?= DOMAIN ?>/blog-images/<?= $image[0]->id ?>.<?= $image[0]->ext ?>">
			
			<?php } ?>
		
		</div>
	
	</div>
	</div>
	</div>

</div>


<div class="footer">
<?php require 'footer.php';?>
</div>