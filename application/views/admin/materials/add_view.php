<div id="content">
<div id="left">
<h2>���������� ������ ��������</h2>
<?=get_tinymce();?>
<form action = "<?=base_url();?>materials/add" enctype="multipart/form-data" method="post">

<p>����� ��������<br />
<input type="text" id="form_char" name="title" value="<?=set_value('title');?>" /><br />
<div id="error"><p><?=form_error('title');?></p></div> 
</p>

<p>����-���� ��������<br />
<input type="text" id="form_char" name="description" value="<?=set_value('description');?>" /><br />
<div id="error"><p><?=form_error('description');?></p></div> 
</p>

<p>������ �����<br />
<input type="text" id="form_char" name="keywords" value="<?=set_value('keywords');?>" /><br />
<div id="error"><p><?=form_error('keywords');?></p></div> 
</p>

<p>̳�-������ ��� ������<br />
<input type="file" name="userfile" size="20" /><br />
</p>

<p>�������� ����<br />
<textarea  name="short_text" id="form_text" cols="75" rows="7"><?=set_value('short_text');?></textarea><br /><a href="javascript:setup();">��������������� TinyMCE</a><br />
<div id="error"><p><?=form_error('short_text');?></p></div> 
</p>

<p>������ �����<br />
<textarea  name="main_text" id="form_text1" cols="75" rows="20"><?=set_value('main_text');?></textarea><br /><a href="javascript:setup();">��������������� TinyMCE</a><br />
<div id="error"><p><?=form_error('main_text');?></p></div> 
</p>

<p>���� ����������<br />
<input type="text" id="form_char" name="date" value = "<? $date = date ("Y-m-d"); echo $date;?>" /><br />
<div id="error"><p><?=form_error('date');?></p></div> 
</p>

<p>���� ���������<br />
<input type="text" id="form_char" name="date_update" value = "<? $date_update = date ("Y-m-d"); echo $date_update;?>" /><br />
<div id="error"><p><?=form_error('date_update');?></p></div> 
</p>

<p>����� ��������<br />
<input type="text" id="form_char" name="author" value="<?=set_value('author');?>" /><br />
<div id="error"><p><?=form_error('author');?></p></div> 
</p>

<p>������� ��������:<br />
<?php	foreach ($all_sections as $one):?>			
<input type="radio" name="section" value="<?=$one['section_id']?>" <?=set_radio('section',$one['section_id'])?> id="<?=$one['section_id']?>" /><label for='<?=$one['section_id']?>'><?=$one['title']?></label><br />                       
<?php endforeach; ?>   
<div id="error"><p><?=form_error('section');?></p></div> 
</p>

<p><input type = "submit" name = "add_button" id = "add_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">������</a>

</div>