<div id="content">
	<div id="left">
		<h2><?=$main_info['title'];?></h2>
        <?=$main_info['main_text'];?>
<div id="wrap">     	
<?php	foreach ($photogallery_photos_list as $one):?>
<a class="gallery_photo" rel="group" title="<?=$one['title']?>" href="<?=base_url().$one['url_big_img']?>">
        <img src="<?=base_url().$one['url_small_img']?>" /></a>
<?php endforeach; ?>
</div>	
<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>    
			<a href="#top">Наверх</a>
	</div>