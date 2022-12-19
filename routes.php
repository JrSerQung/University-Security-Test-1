<?php

require __DIR__.'/includes/config.php';

if( strstr($url, 'blog/') ){

	include('blog-page.php');
	exit;

} elseif(strstr($url, 'product/')){

	include('product-details-page.php');
	exit;

}
$COUNTURL = 0;
$COUNTURL2 = 0;
foreach( $categoryObj->getAll() as $category ){
    if (strpos($slug, $category->seo_url) !== false) {

        $COUNTURL ++;
        $row = $categoryObj->getRowByField('seo_url', $slug);


        $category_id = $category->id;
        $category_title = $category->title;
        include('product-list.php');
    }

}
foreach( $subCategoryObj->getAll() as $category ){
    if (strpos($slug, $category->seo_url) !== false) {

        $COUNTURL2 ++;

        $row = $subCategoryObj->getRowByField('seo_url', $slug);


        $sub_category_id = $category->id;
        $sub_category_title = $category->title;

        include('product-list.php');
    }


}
if($COUNTURL > 0 OR $COUNTURL2 > 0){

}
else{


		include('404.php');


	exit;

}