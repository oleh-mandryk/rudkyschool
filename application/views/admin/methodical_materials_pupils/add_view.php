<div id="content">
<div id="left">
<h2>Добавлення методичного матеріалу для учня</h2>

<form action = "<?=base_url();?>methodical_materials/add_pupils" enctype="multipart/form-data" method="post">

<p>Назва матеріалу<br />
<input type="text" id="form_char" name="title" value="<?=set_value('title');?>" /><br />
<div id="error"><p><?=form_error('title');?></p></div> 
</p>

<p>Клас<br />
<select name="class_id" id="form_select">
<option value="1" <?php echo set_select('class_id', '1'); ?>>1</option>
<option value="2" <?php echo set_select('class_id', '2'); ?>>2</option>
<option value="3" <?php echo set_select('class_id', '3'); ?>>3</option>
<option value="4" <?php echo set_select('class_id', '4'); ?>>4</option>
<option value="5" <?php echo set_select('class_id', '5'); ?>>5</option>
<option value="6" <?php echo set_select('class_id', '6'); ?>>6</option>
<option value="7" <?php echo set_select('class_id', '7'); ?>>7</option>
<option value="8" <?php echo set_select('class_id', '8'); ?>>8</option>
<option value="9" <?php echo set_select('class_id', '9'); ?>>9</option>
<option value="10" <?php echo set_select('class_id', '10'); ?>>10</option>
<option value="11" <?php echo set_select('class_id', '11'); ?>>11</option>
</select>
</p>

<p>Предмет<br />
<input type="text" id="form_char" name="subject_id" value="<?=set_value('subject_id');?>" /><br />
<div id="error"><p><?=form_error('subject_id');?></p></div> 
</p>

<p>Автор<br />
<input type="text" id="form_char" name="author_id" value="<?=set_value('author_id');?>" /><br />
<div id="error"><p><?=form_error('author_id');?></p></div> 
</p>

<p>Дата добавлення<br />
<input type="text" id="form_char" name="date" value = "<? $date = date ("Y-m-d"); echo $date;?>" /><br />
<div id="error"><p><?=form_error('date');?></p></div> 
</p>

<p>Дата оновлення<br />
<input type="text" id="form_char" name="date_update" value = "<? $date_update = date ("Y-m-d"); echo $date_update;?>" /><br />
<div id="error"><p><?=form_error('date_update');?></p></div> 
</p>

<p>Файл<br />
<input type="file" name="userfile" size="20" /><br />
</p>

<p><input type = "submit" name = "add_button" id = "add_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>