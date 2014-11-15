<div id="content">
<div id="left">
<h2>Редагування фотографії</h2>
<?=get_tinymce();?>
<form action = "<?=base_url()."photogallery_photos/update/$photogallery_photo_id";?>" method="post">

<p>Підпис фотографії<br />
<textarea id="form_text" name="title" cols="75" rows="20"><?=set_value('title', $title);?></textarea><br /><a href="javascript:setup();">Використовувати TinyMCE</a><br/>
</p>
<div id="error"><p><?=form_error('title');?></p></div> 

<p>Категорії фотографії<br />
<select name="photogallery_section" id="form_select">
<?php	foreach ($all_photogallery_sections as $one):?>
<option value="<?=$one['photogallery_section_id']?>" <?=populate_select_photo($names_sel,$one['photogallery_section_id']); echo set_select('photogallery_section', $one['photogallery_section_id']); ?>><?=$one['title']?></option>
<?php endforeach; ?>
</select>
</p>

<p>Публікація<br/>
<input type="radio" name="publish_id" value="1" <?=populate_publish($names_pub,1);
echo set_radio('publish_id',1);?> id="1" />
<label for='1'>Так</label>
<input type="radio" name="publish_id" value="0" <?=populate_publish($names_pub,0);
echo set_radio('publish_id',0);?> id="0" />
<label for='0'>Ні</label><br />

<div id="error"><p><?=form_error('publish_id');?></p></div> 
</p>

<p><input type = "submit" name = "update_button" id ="update_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>