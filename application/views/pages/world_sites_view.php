<div id="content">
    <div id="left">
		<h2><?=$main_info['title'];?></h2>
        <table><tr><td><a class="print" href ='javascript:window.print(); void 0; '><img src="../img/printer-icon.jpg"/></a></td></tr></table>
        <?=$main_info['main_text'];?>

<form action = "<?=base_url();?>pages/contact" method="post">

<p>���� ��'�<br/>
<input type="text" id="form_char" name="name" value="<?=set_value('name');?>"/><br/>
<div id="error"><p><?=form_error('name');?></p></div> 
</p>

<p>��� e-mail<br/>
<input type="text" id="form_char" name="email" value="<?=set_value('email');?>"/><br/>
<div id="error"><p><?=form_error('email');?></p></div> 
</p>

<p>���� �����������<br/>
<input type="text" id="form_char" name="topic" value="<?=set_value('topic');?>"/><br/>
<div id="error"><p><?=form_error('topic');?></p></div> 
</p>

<p>����� �����������<br/>
<textarea id="form_text" name="message" cols="50" rows="10"><?=set_value('message');?></textarea><br/>
<div id="error"><p><?=form_error('message');?></p></div> 
</p>

<p>������ ����� � ��������:<br/>
<?=$imgcode?></p>
<p><input type="text" id="form_char" name="captcha"/><br/>
<div id="error"><p><?=form_error('captcha'),$info;?></p></div> 
</p>

<p><input type="submit" name="send_message" id="send_button" value=""/></p>

</form>
<div style="clear: both;">&nbsp;</div>
			<a href="#top">������</a>
	</div>