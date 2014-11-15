<div id="content">
<div id="left">
<h2>Добавлення нової категорії</h2>
<?=get_tinymce();?>
<form action = "<?=base_url();?>photogallery_sections/add" method="post">

<p>Ідентифікатор категорії (ім'я, під яким вона буде доступна в url)<br />
<input type="text" id="form_char" name="photogallery_section_id" value="<?=set_value('photogallery_section_id');?>" /><br />
<div id="error"><p><?=form_error('photogallery_section_id');?></p></div> 
</p>

<p>Назва категорії<br />
<input type="text" id="form_char" name="title" value="<?=set_value('title');?>" /><br />
<div id="error"><p><?=form_error('title');?></p></div> 
</p>

<p>Мета-опис категорії<br />
<input type="text" id="form_char" name="description" value="<?=set_value('description');?>" /><br />
<div id="error"><p><?=form_error('description');?></p></div> 
</p>

<p>Ключові слова<br />
<input type="text" id="form_char" name="keywords" value="<?=set_value('keywords');?>" /><br />
<div id="error"><p><?=form_error('keywords');?></p></div> 
</p>

<p>Основний вміст категорії<br />
<textarea id="form_text" name="main_text" cols="75" rows="20"><?=set_value('main_text');?></textarea><br /><a href="javascript:setup();">Використати TinyMCE</a><br />
</p>

<p><input type = "submit" name = "add_button" id = "add_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>