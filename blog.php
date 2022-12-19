<?php 

require __DIR__.'/includes/config.php';

use App\Blog;
use App\BlogImage;

$blogObj = new Blog;
$blogImageObj = new BlogImage;

function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }

$meta_title = COMPANY_NAME.' | Blog';
require 'header.php';

?>

<img alt="" class="img-responsive" src="images/blog.png">

	<div class="container mb-0 mt-30">
			<div class="col-md-4 hidden-xs hidden-sm" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
			<div class="col-md-4 text-center">  <h1 class="mt-10"><i class="fa fa-comment"></i> BLOG</h1> </div>
			<div class="col-md-4" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
	</div>

<div class="container pt-30 pb-30">

					<div class="panel panel-default">
					<div class="panel-heading"><i class="fa fa-comment"></i> BLOG</div>
						<div class="panel-body">

	<?php foreach( $blogObj->getAll() as $blog_post ){

	$image = $blogImageObj->getAll($blog_post->id);
	
	?>

	<div class="row blog">
	
		<div class="col-md-10 col-xs-9">
		
			<a class="text-decoration-none" href="<?= DOMAIN ?>/blog/<?= $blog_post->seo_url ?>"> <h3 class="mt-0"><?= $blog_post->title ?></h3> </a>
			<p class="mb-20 text-muted mt-10"><em><?= date('d/m/Y', strtotime($blog_post->created_at)) ?></em></p>
			
			<p>
			<?php
			
			print limit_text($blog_post->content, '20');
			
			?>
			</p> <br />
			
			<a class="btn btn-default" href="<?= DOMAIN ?>/blog/<?= $blog_post->seo_url ?>"> View Full Blog Post <i class="fa fa-chevron-right"></i></a>
			
		
		</div>
		
		<div class="col-md-2 col-xs-3">
		
			<?php if( isset($image[0]) ){ ?>
		
			<a href="<?= DOMAIN ?>/blog/<?= $blog_post->seo_url ?>"> <img alt="<?= $image[0]->alt ?>" class="img-responsive" src="<?= DOMAIN ?>/blog-images/<?= $image[0]->id ?>.<?= $image[0]->ext ?>"> </a>
			
			<?php } ?>
		
		</div>
	
	</div>
	
	<hr class="hr" />

	<?php } if(!$blogObj->getAll()){ print '<p class="mb-100">There are currently no blog posts.</p>'; } ?>

</div>
</div>
</div>




<div class="footer">
<?php require 'footer.php';?>
</div>