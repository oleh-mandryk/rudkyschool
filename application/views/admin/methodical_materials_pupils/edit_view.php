<div id="content">
<div id="left">
<h2>Редагування методичного матеріалу для учня</h2>
<form action = "<?=base_url()."methodical_materials/update_pupils/$methodical_materials_pupils_id";?>" method="post">

<p>Назва матеріалу<br />
<input type="text" id="form_char" name="title" value="<?=set_value('title', $title);?>" /><br />
<div id="error"><p><?=form_error('title');?></p></div> 
</p>

<p>Клас<br />
<select name="class_id" id="form_select">
<option value="1" <?=populate_select_admin_pup($names_sel,'1'); echo set_select('class_id','1');?>>1</option>
<option value="2" <?=populate_select_admin_pup($names_sel,'2'); echo set_select('class_id','2');?>>2</option>
<option value="3" <?=populate_select_admin_pup($names_sel,'3'); echo set_select('class_id','3');?>>3</option>
<option value="4" <?=populate_select_admin_pup($names_sel,'4'); echo set_select('class_id','4');?>>4</option>
<option value="5" <?=populate_select_admin_pup($names_sel,'5'); echo set_select('class_id','5');?>>5</option>
<option value="6" <?=populate_select_admin_pup($names_sel,'6'); echo set_select('class_id','6');?>>6</option>
<option value="7" <?=populate_select_admin_pup($names_sel,'7'); echo set_select('class_id','7');?>>7</option>
<option value="8" <?=populate_select_admin_pup($names_sel,'8'); echo set_select('class_id','8');?>>8</option>
<option value="9" <?=populate_select_admin_pup($names_sel,'9'); echo set_select('class_id','9');?>>9</option>
<option value="10" <?=populate_select_admin_pup($names_sel,'10'); echo set_select('class_id','10');?>>10</option>
<option value="11" <?=populate_select_admin_pup($names_sel,'11'); echo set_select('class_id','11');?>>11</option>
</select>
</p>

<p>Предмет<br />
<input type="text" id="form_char" name="subject_id" value="<?=set_value('subject_id', $subject_id);?>" /><br />
<div id="error"><p><?=form_error('subject_id');?></p></div> 
</p>

<p>Автор<br />
<input type="text" id="form_char" name="author_id" value="<?=set_value('author_id', $author_id);?>" /><br />
<div id="error"><p><?=form_error('author_id');?></p></div> 
</p>

<p>Дата добавлення<br />
<input type="text" id="form_char" name="date" value="<?=set_value('date', $date);?>" /><br />
<div id="error"><p><?=form_error('date');?></p></div> 
</p>

<p>Дата оновлення<br />
<input type="text" id="form_char" name="date_update" value = "<? $date_update = date ("Y-m-d"); echo $date_update;?>" /><br />
<div id="error"><p><?=form_error('date_update');?></p></div> 
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