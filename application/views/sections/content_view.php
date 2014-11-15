<div id="content">
    <div id="left">
		<h2><?=$main_info['title'];?></h2>
        <table><tr><td><a class="print" href ='javascript:window.print(); void 0; '><img src="../img/printer-icon.jpg"/></a></td></tr></table>
		<?=$main_info['main_text'];?><br/>
        
        <div style="padding-bottom: 20px; border-top: 1px dashed #60B7DE;"></div>
		<?php foreach ($materials_list as $item):?>
        <div style="padding-top: 10px;"></div>
        <table>
                <tr>
                    <td>
                        <a href = "<?=base_url()."materials/$item[material_id]";?>"><img 
                        src="<?=base_url().$item['small_img_url'];?>"  alt="Міні-іконка"/></a>
                    </td>
                    <td>
                        <h3><a href="<?=base_url()."materials/$item[material_id]";?>"><?=$item['title'];?></a></h3>
                    </td>
                </tr>    
            </table>
        
        
        
        <?=$item['short_text']; ?>
        <p class="meta"> <strong>Додано: </strong><?=$item['date'];?> &bull; <strong>Оновлення: </strong><?=$item['date_update'];?> &bull; <strong>Автор:</strong> <?=$item['author'];?> &bull;  <strong>Кількість переглядів:</strong> <?=$item['count_views'];?> &bull; <a href="<?=base_url()."materials/$item[material_id]";?>">Читати далі</a>
		</p>
        <div style="padding-bottom: 10px; border-bottom: 1px dashed #60B7DE;"></div>			
        <?php endforeach; ?> 
            <div style="clear: both;">&nbsp;</div>
            <div id="pagination"><p><?=$page_nav;?></p></div>    
			<a href="#top">Наверх</a>
		
		</div>