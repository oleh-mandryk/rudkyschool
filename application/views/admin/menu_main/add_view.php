<div id="content">
<div id="left">
<h2>Добавлення нового пункту головного меню</h2>
<?=get_tinymce();?>
<form action = "<?=base_url();?>menu_main/add" method="post">

<p>Ідентифікатор пункту меню (ім'я, під яким він буде доступний в url)<br />
<input type="text" id="form_char" name="name_item_id" value="<?=set_value('name_item_id');?>" /><br />
<div id="error"><p><?=form_error('name_item_id');?></p></div> 
</p>

<p>Назва пункту меню<br />
<input type="text" id="form_char" name="name_item" value="<?=set_value('name_item');?>" /><br />
<div id="error"><p><?=form_error('name_item');?></p></div> 
</p>

<p>URL адреса<br />
<input type="text" id="form_char" name="url_item" value="<?=set_value('url_item');?>" /><br />
<div id="error"><p><?=form_error('url_item');?></p></div> 
</p>

<p><input type = "submit" name = "add_button" id = "add_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>