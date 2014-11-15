<div id="footer">
	<table align="center">
        <tr>
            <td>
            <?php foreach ($img_footer as $item):?>
                <a href = "<?=$item['url_address'];?>"target="blank"><img src="<?=base_url().$item['img_url'];?>" alt="<?=$item['alt_text'];?>" /></a>
            <?php endforeach;?>
            <!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t18.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показане число переглядів за 24"+
" години, відвідувачів за 24 години й за сьогодні' "+
"border='0' width='88' height='31'><\/a>")
//--></script><!--/LiveInternet-->
                
            </td>
        </tr>
    </table>
<p>Copyright &copy; 2011 Рудківська СЗШ І-ІІІ ступенів. Розробка і підтримка О.М.Мандрик</p>
</div>
    <script type="text/javascript" src="<?=base_url();?>js/jquery.easing.1.3.js">   </script>
    <script type="text/javascript" src="<?=base_url();?>js/jquery.fancybox-1.2.1.pack.js">    </script>
    <script type="text/javascript">
    $("a.gallery").fancybox(
    {
        "imageScale" : true, 
        "zoomOpacity" : false,
        "zoomSpeedIn" : 500,	
        "zoomSpeedOut" : 500,	
        "zoomSpeedChange" : 1000, 
        "frameWidth" : 640,	 
        "frameHeight" : 480, 
        "overlayShow" : true, 
        "overlayOpacity" : 0.9,	
        "hideOnContentClick" :false,
        "centerOnScroll" : false
    });
    </script>
    
    <script type="text/javascript">
    $("a.gallery_photo").fancybox(
    {
        "imageScale" : true, 
        "zoomOpacity" : false,
        "zoomSpeedIn" : 500,	
        "zoomSpeedOut" : 500,	
        "zoomSpeedChange" : 1000, 
        "frameWidth" : 640,	 
        "frameHeight" : 480, 
        "overlayShow" : true, 
        "overlayOpacity" : 0.9,	
        "hideOnContentClick" :false,
        "centerOnScroll" : false
    });
    </script>
</body>
</html>
