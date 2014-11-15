<div id="right">
		<h2>Пошук на сайті</h2>
        <form action="<?=base_url();?>search" method="post" >
        <p><input type="text" name="search" id="search_text" maxlength="50" value="<?=set_value('search');?>" /></p>
        <div id="error"><?=form_error('search');?></div>
        <p><input type="submit" name = "search_button" id="search_button" value="" /></p>
        </form>
        
        <h2>Розклад занять</h2>
        <ul>
        <li><a href="<?=base_url();?>schedule_pupils">учням</a></li>
        <li><a href="<?=base_url();?>schedule_teachers">вчителям</a></li>
        </ul>
        
        <div style="border-top: 1px dashed #60B7DE;"></div>
        <h2>Методичні метеріали</h2>
        <ul>
        <li><a href="<?=base_url();?>methodical_materials_pupils">учням</a></li>
        <li><a href="<?=base_url();?>methodical_materials_teachers">вчителям</a></li>
        </ul>
        <div style="border-top: 1px dashed #60B7DE;"></div>
        <h2>Крилаті фрази</h2>
        <p><q><?=$winged_phrases['main_text'];?></q><br/>
        <cite><?=$winged_phrases['author'];?></cite></p>
        <div style="border-top: 1px dashed #60B7DE;"></div>
        <h2>Цікаво знати</h2>
        <?=$i_wonder['main_text'];?>
        <div style="border-top: 1px dashed #60B7DE;"></div>
       <h2>Голосування</h2>
                <div id="questions_vote">
                    <p><strong>
                    <?=$questions_vote_all[0]['ques']?>
                    
                    </strong></p>
                </div>
                    <form name="poll" id='poll' action="<?=base_url();?>poll" method="post">
					<?php	foreach ($options_vote_all as $one):?>
                    <input type="radio" name="poll" value="<?=$one['option_id']?>" id="<?=$one['option_id']?>" /><label for='<?=$one['option_id']?>'>&nbsp;<?=$one['value']?></label><br />                       
                    <?php endforeach; ?>
                        <p>
                            <input type="submit" name = "vote_button" id="vote_button" value="" />
                            <input type="submit" name = "result_button" id="result_button" value="" />
                        </p>
					</form>
        
        <h2>Оновлення</h2>
        <ul>
            <?php	foreach ($update_materias as $one):?>
            <li><a href="<?=base_url();?>materials/<?=$one['material_id'];?>"><?=$one['title'];?> (<?=$one['date_update'];?>)</a></li>
            <?php endforeach; ?>
        </ul>
        <div style="border-top: 1px dashed #60B7DE;"></div>
        <h2>Орфографія</h2>
        <p><center><script type="text/javascript" src="/js/orphus.js"></script>
        <a href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="/img/orphus.gif" border="0" width="160" height="122" /></a></center>
        </p>
        <h2>Реклама від Google</h2>
        	<p><center>
                <script type="text/javascript"><!--
google_ad_client = "ca-pub-7269868779792078";
/* rudkyschool.lviv.ua */
google_ad_slot = "3766403123";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></center>
                </p>
     </div>
</div>
