<div id="content">
<div id="left">
<h2>Редагування матеріалу</h2>
<?=get_tinymce();?>
<form action = "<?=base_url()."materials/update/$material_id";?>" method="post">

<p>Назва матеріалу<br />
<input type="text" id="form_char" name="title" value="<?=set_value('title', $title);?>" /><br />
<div id="error"><p><?=form_error('title');?></p></div> 
</p>

<p>Мета-опис матеріалу<br />
<input type="text" id="form_char" name="description" value="<?=set_value('description', $description);?>" /><br />
<div id="error"><p><?=form_error('description');?></p></div> 
</p>

<p>Ключові слова<br />
<input type="text" id="form_char" name="keywords" value="<?=set_value('keywords', $keywords);?>" /><br />
<div id="error"><p><?=form_error('keywords');?></p></div> 
</p>

<p>Короткий опис<br />
<textarea id="form_text" name="short_text" id="short_text" cols="75" rows="7"><?=set_value('short_text', $short_text);?></textarea><br /><a href="javascript:setup();">Використовувати TinyMCE</a><br />
<div id="error"><p><?=form_error('short_text');?></p></div> 
</p>

<p>Повний текст<br />
<textarea id="form_text1" name="main_text" id="main_text" cols="75" rows="20"><?=set_value('main_text', $main_text);?></textarea><br /><a href="javascript:setup();">Використовувати TinyMCE</a><br />
<div id="error"><p><?=form_error('main_text');?></p></div> 
</p>

<p>Дата добавлення<br />
<input type="text" id="form_char" name="date" value="<?=set_value('date', $date);?>" /><br />
<div id="error"><p><?=form_error('date');?></p></div> 
</p>

<p>Дата оновлення<br />
<input type="text" id="form_char" name="date_update" value = "<? $date_update = date ("Y-m-d"); echo $date_update;?>" /><br />
<div id="error"><p><?=form_error('date_update');?></p></div> 
</p>

<p>Автор матеріалу<br />
<input type="text" id="form_char" name="author" value="<?=set_value('author', $author);?>" /><br />
<div id="error"><p><?=form_error('author');?></p></div> 
</p>

<p>Категорії матеріалу:<br />
<?php	foreach ($all_sections as $one):?>			
<input type="radio" name="section" value="<?=$one['section_id']?>" <?=populate($names,$one['section_id']);
echo set_radio('section',$one['section_id']);?> id="<?=$one['section_id']?>" />
<label for='<?=$one['section_id']?>'><?=$one['title']?></label><br />                       
<?php endforeach; ?>
<div id="error"><p><?=form_error('section');?></p></div> 
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

<p><input type = "submit" name = "update_button" id = "update_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>             