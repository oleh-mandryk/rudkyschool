<div id="content">
<div id="left">
<h2>���������� ���� ����������</h2>
<?=get_tinymce();?>
<form action = "<?=base_url();?>photogallery_photos/add" enctype="multipart/form-data" method="post">

<p>ϳ���� ����������<br />
<textarea id="form_text" name="title" cols="75" rows="20"><?=set_value('title');?></textarea><br /><a href="javascript:setup();">����������� TinyMCE</a><br />
</p>
<div id="error"><p><?=form_error('title');?></p></div> 

<p>������� ����������<br />
<select name="photogallery_section" id="form_select">
<?php	foreach ($all_photogallery_sections as $one):?>
<option value="<?=$one['photogallery_section_id']?>" <?php echo set_select('photogallery_section', $one['photogallery_section_id']); ?>><?=$one['title']?></option>
<?php endforeach; ?>
</select>
</p>

<p>���� ����������<br />
<input type="text" id="form_char" name="date" value = "<? $date = date ("Y-m-d"); echo $date;?>" /><br />
<div id="error"><p><?=form_error('date');?></p></div> 
</p>

<p>����������<br />
<input type="file" name="userfile" size="20" /><br />
</p>

<p><input type = "submit" name = "add_button" id = "add_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">������</a>

</div>