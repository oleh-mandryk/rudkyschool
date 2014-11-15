<div id="content">
<div id="left">
<h2>Редагування налаштувань</h2>
<form action = "<?=base_url();?>administration/preferences" method="post">

<p>Задати логін<br />
<input type="text" id="form_char" name="admin_login" value="<?=set_value('admin_login', $this->config->item('admin_login'));?>" size="20" /><br />
<div id="error"><p><?=form_error('admin_login');?></p></div> 
</p>

<p>Задати пароль<br />
<input type="password" id="form_char" name="admin_pass" value="<?=set_value('admin_pass', $this->config->item('admin_pass'));?>" size="20" /><br />
<div id="error"><p><?=form_error('admin_pass');?></p></div> 
</p>

<p>Матеріалів на сторінку для частини користувача<br />
<input type="text" id="form_char" name="user_per_page" value="<?=set_value('user_per_page', $this->config->item('user_per_page'));?>" size="4" /><br />
<div id="error"><p><?=form_error('user_per_page');?></p></div> 
</p>

<p>Матеріалів на сторінку для частини адміністратора<br />
<input type="text" id="form_char" name="admin_per_page" value="<?=set_value('admin_per_page', $this->config->item('admin_per_page'));?>" size="4" /><br />
<div id="error"><p><?=form_error('admin_per_page');?></p></div> 
</p>

<p>Результатів пошуку на сторінку<br />
<input type="text" id="form_char" name="search_per_page" value="<?=set_value('search_per_page', $this->config->item('search_per_page'));?>" size="4" /><br />
<div id="error"><p><?=form_error('search_per_page');?></p></div> 
</p>

<p>Фотографій на сторінку для частини користувача<br />
<input type="text" id="form_char" name="user_per_photo" value="<?=set_value('user_per_photo', $this->config->item('user_per_photo'));?>" size="4" /><br />
<div id="error"><p><?=form_error('user_per_photo');?></p></div> 
</p>

<p><input type = "submit" name = "update_button" id = "update_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>