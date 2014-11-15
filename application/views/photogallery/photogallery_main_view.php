<div id="content">
	<div id="left">
	<h2>Фотогалерея</h2>	
    <table>
        <?php	foreach ($all_photogallery_sections as $one):?>
        <tr>
            <td>
                <a class="gallery_section" href="<?=base_url()."photogallery_sections/".$one['photogallery_section_id'];?>"><img src="<?=base_url().$one['small_img_url']?>" /></a>
            </td>
            <td class="rowE">
            <p class="meta_photo">
            <strong><?=$one['title'];?></strong><br />
            <em>(зображень <?=$one['count_photo'];?>)</em>
            </p>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    
    




<div style="clear: both;">&nbsp;</div>
			<a href="#top">Наверх</a>
	</div>





 
