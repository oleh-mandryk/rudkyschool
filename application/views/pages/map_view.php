<div id="content">
    <div id="left">
		<h2><?=$main_info['title'];?></h2>
        <table><tr><td><a class="print" href ='javascript:window.print(); void 0; '><img src="../img/printer-icon.jpg"/></a></td></tr></table>
<?=$main_info['main_text'];?>

<?php	foreach ($menu_top as $one):?>
<p><a href="<?=base_url().$one['url_item'];?>"><?=$one['name_item']?></a></p>
<?php endforeach; ?>


<?php	foreach ($menu_main as $one):?>
<p><a href="<?=base_url().$one['url_item'];?>"><?=$one['name_item']?></a></p>
<ul>
<?php	foreach ($all_materials as $item):?>
<?php	if ($item['section']==$one['name_item_id']){?>

<li><a href = "<?=base_url()."materials/$item[material_id]";?>"><?=$item['title'];?></a></li>
<?php } ?>

<?php endforeach; ?>
</ul>

<?php endforeach; ?> 

<div style="clear: both;">&nbsp;</div>
			<a href="#top">������</a>
	</div>





 
