<div id="header">
<div id="topmenu">
              
        <?php	foreach ($menu_top as $one):?>
            <a href="<?=base_url().$one['url_item'];?>"><img src="<?=base_url().$one['url_img'];?>" alt="Зображення" /></a><br/>
        <?php endforeach; ?> 
        
    </div>	
</div>