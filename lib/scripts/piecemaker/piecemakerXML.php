<?php require_once( '../../../wp-load.php' );

$options = get_option('kjd_cycler_images_settings');
$cyclerOptions = get_option('kjd_cycler_misc_settings');

$segments = get_option('nt_segments');
$tweentime = get_option('nt_tween_time');
$tweendelay = get_option('nt_tween_delay');
$tweentype = get_option('nt_tween_type');
$zdistance = get_option('nt_z_distance');
$expand = get_option('nt_expand');
$innercolor = get_option('nt_inner_color');
$textbackground = get_option('nt_text_background');
$textdistance = get_option('nt_text_distance');
$shadow = get_option('nt_shadow_darknent');
$autoplay = get_option('nt_autoplay');
?>

<?php
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8" ?>
<Piecemaker>
  <Settings>
	<imageWidth>830</imageWidth>
	<imageHeight>360</imageHeight>';



echo '<segments>'. $segments . '</segments>';
echo '<tweenTime>'. $tweentime . '</tweenTime>';
echo '<tweenDelay>'. $tweendelay . '</tweenDelay>';
echo '<tweenType>'. $tweentype . '</tweenType>';
echo '<zDistance>'. $zdistance . '</zDistance>';
echo '<expand>'. $expand . '</expand>';
echo '<innerColor>'. $innercolor . '</innerColor>';
echo '<textBackground>'. $textbackground . '</textBackground>';
echo '<textDistance>'. $textdistance . '</textDistance>';
echo '<shadowDarknent>' . $shadow . '</shadowDarkn3dent>';
echo '<autoplay>' . $autoplay .  '</autoplay>'; 
echo '
</Settings>




<Image Filename="image1.jpg">
    <Text>
      <headline>Description Text</headline>
      <break>Ӂ</break>
      <paragraph>Here you can add a description text for every single slide.</paragraph>
      <break>Ӂ</break>
      <inline>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu quam dolor, a venenatis nisl. Praesent scelerisque iaculis fringilla. Sed congue placerat eleifend.</inline>
      Ӂ<a href="http://themes.5-squared.com/sansation/?style=cool_blue" target="_blank">hyperlinks</a>
    </Text>
  </Image>




  <Image Filename="image2.jpg">
    <Text>
      <headline>Description Text</headline>
      <break>Ӂ</break>
      <paragraph>Here you can add a description text for every single slide.</paragraph>
      <break>Ӂ</break>
      <inline>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu quam dolor, a venenatis nisl. Praesent scelerisque iaculis fringilla. Sed congue placerat eleifend.</inline>
      Ӂ<a href="http://themes.5-squared.com/sansation/?style=cool_blue" target="_blank">hyperlinks</a>
    </Text>
  </Image>




  <Image Filename="image3.jpg">
    <Text>
      <headline>Description Text</headline>
      <break>Ӂ</break>
      <paragraph>Here you can add a description text for every single slide.</paragraph>
      <break>Ӂ</break>
      <inline>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu quam dolor, a venenatis nisl. Praesent scelerisque iaculis fringilla. Sed congue placerat eleifend.</inline>
      Ӂ<a href="http://themes.5-squared.com/sansation/?style=cool_blue" target="_blank">hyperlinks</a>
    </Text>
  </Image>




  <Image Filename="image4.jpg">
    <Text>
      <headline>Description Text</headline>
      <break>Ӂ</break>
      <paragraph>Here you can add a description text for every single slide.</paragraph>
      <break>Ӂ</break>
      <inline>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu quam dolor, a venenatis nisl. Praesent scelerisque iaculis fringilla. Sed congue placerat eleifend.</inline>
      Ӂ<a href="http://themes.5-squared.com/sansation/?style=cool_blue" target="_blank">hyperlinks</a>
    </Text>
  </Image>
</Piecemaker>';
?>
