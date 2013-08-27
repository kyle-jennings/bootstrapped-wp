<?php 
function load_custom_style(){

$options = get_option('kjd_login_misc_settings');
$logo = $options['kjd_loginPage_logo'];

$options = get_option('kjd_login_background_settings');

$loginBackgroundColorSettings = $options['kjd_login_background_colors'];
$loginBackgroundWallpaperSettings = $options['kjd_login_background_wallpaper'];

$backgroundGradient = $loginBackgroundColorSettings['gradient'];
$startColor = $loginBackgroundColorSettings['color'];
$endColor = $loginBackgroundColorSettings['endcolor'];

$textOptions = get_option('kjd_login_text_settings');
$loginText = $textOptions['kjd_login_text'];

$linkOptions = get_option('kjd_login_links_settings');
$loginLink = $linkOptions['kjd_login_link'];
$loginLinkHovered = $linkOptions['kjd_login_linkHovered'];
$loginLinkVisited = $linkOptions['kjd_login_linkVisited'];
$loginLinkActive = $linkOptions['kjd_login_linkActive'];


$formOptions = get_option('kjd_login_components_settings');
$loginForm = $formOptions['kjd_login_components']['forms'];

$root=get_bloginfo('template_directory'); 
$root.= $root.'/lib/';
?>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="<?php echo $root; ?>/scripts/jquery.js" type="text/javascript"></script>


<script>
	jQuery(document).ready(function($) {  
		var url = $('.login h1 a').css('background-image').replace('url(', '').replace(')', '').replace("'", '').replace('"', '').replace('"', '');
		var bgImg = $('<img />');
		bgImg.hide();
		bgImg.bind('load', function()
		{
		    var width = $(this).width();
		    var height = $(this).height();
		    
		    if($(window).width() > 480){
			    if(width > 320){
			    	$('#login,.login h1 a').width(width);	
			    }
    			$('.login h1 a').css('background-size',width+"px");
    		$('.login h1 a').height(height);
		    }


			
		});
		$('.login h1 a').append(bgImg);
		bgImg.attr('src', url);

	});
</script>
<style>

body.login{
<?php
	/* start background colors */
	if($backgroundGradient =='vertical'){
		verticalGradientCallback($startColor, $endColor);
	}elseif($backgroundGradient =='horizontal'){ 
		horizontalGradientCallback($startColor, $endColor);
	}elseif($backgroundGradient =='radial'){ 
		radialGradientCallback($startColor, $endColor);
	}elseif($backgroundGradient =='solid'){ ?>
		background-color: <?php echo $startColor;?> !important;
	<?php 
	}elseif($backgroundGradient =='none'){ ?>
		background-color:none !important;
	<?php
	}

	if($loginBackgroundWallpaperSettings['use_wallpaper']=='true'){
		wallpaperCallback($loginBackgroundWallpaperSettings['image'], $loginBackgroundWallpaperSettings['position'], $loginBackgroundWallpaperSettings['repeat']);			
	}
?>

}
<?php if(isset($logo) && $logo!='' && $logo!= ' '){ ?>

.login h1 a{background-image:url(<?php echo $logo; ?>); background-repeat: no-repeat !important; margin-bottom:20px; }
<?php } ?>



.login #nav a, .login #backtoblog a, #nav > a, a{
color:<?php echo $loginLink['color'];?> !important; 
text-decoration:<?php echo $loginLink['decoration']; ?> !important; 
text-shadow:0 1px 0 <?php echo $loginLink['textShadowColor']; ?> !important;
}

.login #nav a:hover, .login #backtoblog a:hover, #nav > a:hover, a:hover{
	color:<?php echo $loginLinkHovered['color'];?> !important;
	text-decoration:<?php echo $loginLinkHovered['decoration']; ?> !important; 
	text-shadow:0 1px 0 <?php echo $loginLinkHovered['textShadowColor']; ?> !important;
}

form, 
#loginform,
.login form{
	background-color:<?php echo $loginForm['form_background'];?> !important;
	border-color:<?php echo $loginForm['form_border'];?> !important;
	color:<?php echo $loginForm['form_text'];?> !important;
}

.login label {
	color:<?php echo $loginForm['form_text'];?> !important;	
}

form input, .input, #rememberme{
	background-color:<?php echo $loginForm['field_background'];?> !important;
	border-color:<?php echo $loginForm['field_border'];?> !important;
	color:<?php echo $loginForm['field_text'];?> !important;
}
form input[type='checkbox']{
	background-color:<?php echo $loginForm['field_background'];?> !important;
}

form input:focus, #rememberme:focus{
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px <?php echo $loginForm['field_glow']; ?>;
}
#wp-submit{
 	box-shadow: none;
	background:<?php verticalGradientCallback($loginForm['button_background'],$loginForm['button_background_end']);?> !important;
	border-color:<?php echo $loginForm['button_border'];?> !important;
	color:<?php echo $loginForm['button_text'];?> !important;
}

#wp-submit:hover,#wp-submit:active{
	background-color:<?php echo $loginForm['button_bg_end'];?> !important;
}

}

@media (max-width: 480px) {
	#login, .login h1 a{
		width: 90%;
	}
}

</style>


<?php 

}
////////////////////////
// vertical gradient
function verticalGradientCallback($startColor, $endColor){ ?>
<?php if(isset($startColor) && $startColor !=""){ 
		if(!isset($endcolor) || $endcolor == ""){
			$endcolor == "#ffffff";
		}
?>
				background-color: <?php echo $startColor;?>;
				background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $startColor;?>), to(<?php echo $endColor;?>));
				background-image: -webkit-linear-gradient(top, <?php echo $startColor;?>, <?php echo $endColor;?>);
				background-image: -moz-linear-gradient(top, <?php echo $startColor;?>, <?php echo $endColor;?>);
				background-image: -ms-linear-gradient(top, <?php echo $startColor;?>, <?php echo $endColor;?>);
				background-image: -o-linear-gradient(top, <?php echo $startColor;?>, <?php echo $endColor;?>);
				filter:  progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='<?php echo $startColor;?>', endColorstr='<?php echo $endColor;?>'); /* IE6 & IE7 */
5
		    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='<?php echo $startColor;?>', endColorstr='<?php echo $endColor;?>')"; /* IE8 */
<?php	}?>
<?php
}// end vertical 

////////////////////////
// horizontal gradient
function horizontalGradientCallback($startColor, $endColor){ ?>
<?php if(isset($startColor) && $startColor !=""){ 
		if(!isset($endcolor) || $endcolor == ""){
			$endcolor == "#ffffff";
		}
		?>
				background-color: <?php echo $startColor;?>;
		  background-image: -webkit-gradient(linear, left top, right top, from(<?php echo $startColor;?>), color-stop(0.5,  <?php echo $endColor;?>), to( <?php echo $startColor;?>));
				background-image: -webkit-linear-gradient(left, <?php echo $startColor;?>, <?php echo $endColor;?>,<?php echo $startColor;?>);
				background-image: -moz-linear-gradient(left, <?php echo $startColor;?>, <?php echo $endColor;?>,<?php echo $startColor;?>);
				background-image: -ms-linear-gradient(left, <?php echo $startColor;?>, <?php echo $endColor;?>,<?php echo $startColor;?>);
				background-image: -o-linear-gradient(left, <?php echo $startColor;?>, <?php echo $endColor;?>,<?php echo $startColor;?>);
				filter:  progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr='<?php echo $startColor;?>', endColorstr='<?php echo $endColor;?>'); /* IE6 & IE7 */
5
		    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr='<?php echo $startColor;?>', endColorstr='<?php echo $endColor;?>')"; /* IE8 */
<?php	}?>

<?php
}

////////////////////////
// radial Gradient
function radialGradientCallback($startColor, $endColor){ ?>

<?php if(isset($startColor) && $startColor !=""){ 
		if(!isset($endcolor) || $endcolor == ""){
			$endcolor == "#ffffff";
		}
	?>
				background-color: <?php echo $startColor;?>;
				background-image: -webkit-gradient(radial, center center, 0, center center, 460, from(<?php echo $startColor;?>), to(<?php echo $endColor;?>));
				background-image: -webkit-radial-gradient(circle, <?php echo $startColor;?>, <?php echo $endColor;?>);
				background-image: -moz-radial-gradient(circle, <?php echo $startColor;?>, <?php echo $endColor;?>);
				background-image: -ms-radial-gradient(circle, <?php echo $startColor;?>, <?php echo $endColor;?>);
<?php	}?>

<?php
}

////////////////////////
// use wallpaper
function wallpaperCallback($backgroundImage, $backgroundPosition, $backgroundRepeat){
	if(isset($backgroundImage) && $backgroundImage!=""){ ?>
		background-image:url(<?php echo $backgroundImage ;?>);<?php	
	}

	if(isset($backgroundPosition) && $backgroundPosition!=""){ ?>
		background-position:<?php echo $backgroundPosition;?>; <?php	
	}
	if(isset($backgroundRepeat) && $backgroundRepeat!=""){ ?>
		background-repeat:<?php echo $backgroundRepeat;?>; <?php	
	}
}


load_custom_style();
?>