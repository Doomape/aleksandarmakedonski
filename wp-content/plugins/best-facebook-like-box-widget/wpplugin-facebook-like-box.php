<?php
/*
 * Plugin Name: Best Facebook Like Box widget
 * Version: 1.0
 * Plugin URI: http://wpspecialplugin.com/best-facebook-fan-box-widget/
 * Description:Best Facebook Like Box widget  for WordPress is a social plugin that enables Facebook Page owners to attract and gain Likes from their own website. The Like Box enables users to: see how many users already like this page, and which of their friends like it too, read recent posts from the page and Like the page with one click, without needing to visit the page.
 * Author: lamb5rifle
 * Author URI: http://wpspecialplugin.com
 * License: GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
 /*  Copyright 2012  lamb5rifle

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
class BestFacebookLikeBoxWidget extends WP_Widget
{
	/**
	* Declares the BestFacebookLikeBoxWidget class.
	*
	*/
	function BestFacebookLikeBoxWidget(){
		$widget_ops = array('classname' => 'widget_FacebookLikeBox', 'description' =>  "Facebook Like Box Widget is a social plugin that enables Facebook Page owners to attract and gain Likes from their own website." );
		$control_ops = array('width' => 250, 'height' => 250);
		$this->WP_Widget('FacebookLikeBox', 'wpplugin Facebook Like Box', $widget_ops, $control_ops);
	}
	function widget($args, $instance){
		extract($args);
		$title_widget_tube = apply_filters('widget_title', empty($instance['title']) ? 'wpplugin Facebook Like Box' : $instance['title']);
        $fb_page = htmlspecialchars($instance['fbpage']);
        $width = empty($instance['width']) ? '250' : $instance['width'];
		$height = empty($instance['height']) ? '300' : $instance['height'];
        $theme =empty($instance['theme']) ? 'light' : $instance['theme'];
        $faces =empty($instance['faces']) ? 'true' : $instance['faces'];
        $border_color =empty($instance['color']) ? 'CCCCCC' : $instance['color'];
        $fbstream =empty($instance['fbstream']) ? 'true' : $instance['fbstream'];
        $fbheader =empty($instance['fbheader']) ? 'true' : $instance['fbheader'];
        $fbwall =empty($instance['fbwall']) ? 'true' : $instance['fbwall'];
        $oldlook =empty($instance['oldlook']) ? 'true' : $instance['oldlook'];
        $langlocale =empty($instance['fblang']) ? 'en_US' : $instance['fblang'];
        $customclass =empty($instance['customclass']) ? '' : $instance['customclass'];
        if($fbstream=='true'){$height=$height+300;}
        if ($oldlook=='true'){$lookpage='//www.facebook.com/plugins/likebox.php';$bottom1=''; $bottom='';}else{$lookpage='http://www.connect.facebook.com/widgets/fan.php';$bottom1='<div style="width:'.$width.'px; height:'.$height.'px; border-bottom:1px solid #94A3C4; display:block;">'; $bottom='</div>';}
        if ($customclass ==''){$div1=''; $div2='';}else{$div1='<div class="'.$customclass.'">';$div2='</div>';}
        if (strpos($fb_page, "http://www.facebook.com") !== false  ) {
        $facebook_likebox = $div1.$bottom1.'<iframe src="'.$lookpage.'?href='.rawurlencode($fb_page).'&amp;width='.$width.'&amp;height='.$height.'&amp;colorscheme='.$theme.'&amp;show_faces='.$faces.'&amp;border_color=%23'.$border_color.'&amp;stream='.$fbstream.'&amp;header='.$fbheader.'&amp;force_wall='.$fbwall.'&amp;locale='.$langlocale.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>'.$bottom.$div2;
        }else{
        $facebook_likebox ='<div style="padding:5px;background:#FFCC99;border:1px solid #FF9966;">&nbsp;Insert Your Facebook page URL.</div>';
        }
		echo $before_widget;
		if ( $title_widget_tube )
		echo $before_title . $title_widget_tube . $after_title;
        echo $facebook_likebox;
		echo $after_widget;
	}
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['fbpage'] = strip_tags(stripslashes($new_instance['fbpage']));
        $instance['width'] = strip_tags(stripslashes($new_instance['width']));
		$instance['height'] = strip_tags(stripslashes($new_instance['height']));
        $instance['theme'] = strip_tags(stripslashes($new_instance['theme']));
        $instance['faces'] = strip_tags(stripslashes($new_instance['faces']));
        $instance['color'] = strip_tags(stripslashes($new_instance['color']));
        $instance['fbstream'] = strip_tags(stripslashes($new_instance['fbstream']));
        $instance['fbheader'] = strip_tags(stripslashes($new_instance['fbheader']));
        $instance['fbwall'] = strip_tags(stripslashes($new_instance['fbwall']));
        $instance['fblang'] = strip_tags(stripslashes($new_instance['fblang']));
        $instance['customclass'] = strip_tags(stripslashes($new_instance['customclass']));
        $instance['oldlook'] = strip_tags(stripslashes($new_instance['oldlook']));
		return $instance;
	}
	function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'','fbpage'=>'','width'=>'250','height'=>'300','theme'=>'light','faces'=>'true','color'=>'CCCCCC','fbstream'=>'true','fbheader'=>'true','fbwall'=>'true','fblang'=>'en_US','customclass'=>'','oldlook'=>'true') );
        $title_widget_tube = htmlspecialchars($instance['title']);
        $fb_page = htmlspecialchars($instance['fbpage']);
        $width = empty($instance['width']) ? '250' : $instance['width'];
		$height = empty($instance['height']) ? '300' : $instance['height'];
        $theme =empty($instance['theme']) ? 'light' : $instance['theme'];
        $faces =empty($instance['faces']) ? 'true' : $instance['faces'];
        $border_color =empty($instance['color']) ? 'CCCCCC' : $instance['color'];
        $fbstream =empty($instance['fbstream']) ? 'true' : $instance['fbstream'];
        $fbheader =empty($instance['fbheader']) ? 'true' : $instance['fbheader'];
        $fbwall =empty($instance['fbwall']) ? 'true' : $instance['fbwall'];
        $langlocale =empty($instance['fblang']) ? 'en_US' : $instance['fblang'];
        $customclass =empty($instance['customclass']) ? '' : $instance['customclass'];
        $oldlook =empty($instance['oldlook']) ? 'true' : $instance['oldlook'];
		echo '<p style="text-align:left;"><label for="' . $this->get_field_name('title') . '"><b><span style="color:#2680AA;">Widget title: </span></b><input style="width:230px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title_widget_tube . '" /></label></p>';
?> <hr style=" border:#2680AA 1px solid;">
   <p><b><span style="color:#2680AA;">Facebook Page URL : </span></b><br />
   <input name="<?php echo  $this->get_field_name('fbpage'); ?>" id="<?php echo  $this->get_field_name('fbpage'); ?>" value="<?php echo $fb_page; ?>" size="35"   type="text">
   <br /><small>(<i>The URL of the Facebook Page for this Like box widget.</i>)</small></p>  <hr style=" border:#2680AA 1px solid;">
   <label for="<?php echo  $this->get_field_name('width'); ?>"><b><span style="color:#2680AA;">Width: </span></b></label>
   <input name="<?php echo  $this->get_field_name('width'); ?>" id="<?php echo  $this->get_field_name('width'); ?>" value="<?php echo $width; ?>" size="2"   type="text">&nbsp;px
   <br /><small>(<i>The width of the widget in pixels.</i>)</small><br />
   <label for="<?php echo  $this->get_field_name('height'); ?>"><b><span style="color:#2680AA;">Height: </span></b></label>
   <input name="<?php echo  $this->get_field_name('height'); ?>" id="<?php echo  $this->get_field_name('height'); ?>" value="<?php echo $height; ?>" size="2"   type="text">&nbsp;px
   <br /><small>(<i>The width of the height in pixels.</i>)</small><br />
   <label for="<?php echo  $this->get_field_name('theme'); ?>"><b><span style="color:#2680AA;">Color scheme: </span></b></label>
   <select name="<?php echo  $this->get_field_name('theme'); ?>" id="<?php echo  $this->get_field_name('theme'); ?>">
   <option value="dark" <?php if ($theme == 'dark') echo 'selected="Dark"'; ?> >Dark</option>
   <option value="light" <?php if ($theme == 'light') echo 'selected="Light"'; ?> >Light</option>
   </select>
   <br /><small>(<i>Choose color scheme.</i>)</small><br />
   <label for="<?php echo  $this->get_field_name('oldlook'); ?>"><b><span style="color:#2680AA;">Old look: </span></b></label>
   <select name="<?php echo  $this->get_field_name('oldlook'); ?>" id="<?php echo  $this->get_field_name('oldlook'); ?>">
   <option value="true" <?php if ($oldlook == 'true') echo 'selected="Show LikeBox"'; ?> >Show LikeBox</option>
   <option value="false" <?php if ($oldlook == 'false') echo 'selected="Show FanBoX"'; ?> >Show FanBoX</option>
   </select>
   <br /><small>(<i>Old look or fanbox before likebox.</i>)</small><br />
   <label for="<?php echo  $this->get_field_name('faces'); ?>"><b><span style="color:#2680AA;">Show Faces: </span></b></label>
   <select name="<?php echo  $this->get_field_name('faces'); ?>" id="<?php echo  $this->get_field_name('faces'); ?>">
   <option value="true" <?php if ($faces == 'true') echo 'selected="Show faces"'; ?> >Show faces</option>
   <option value="false" <?php if ($faces == 'false') echo 'selected="Hide faces"'; ?> >Hide faces</option>
   </select>
   <br /><small>(<i>Show profile photos in the widget.</i>)</small><br />
   <label for="<?php echo  $this->get_field_name('color'); ?>"><b><span style="color:#2680AA;">Border color: </span></b></label>
   # <input name="<?php echo  $this->get_field_name('color'); ?>" id="<?php echo  $this->get_field_name('color'); ?>" value="<?php echo $border_color; ?>" size="5"   type="text">&nbsp;

   <label for="<?php echo  $this->get_field_name('fbstream'); ?>"><b><span style="color:#2680AA;">Show stream: </span></b></label>
   <select name="<?php echo  $this->get_field_name('fbstream'); ?>" id="<?php echo  $this->get_field_name('fbstream'); ?>">
   <option value="true" <?php if ($fbstream == 'true') echo 'selected="Show stream"'; ?> >Show stream</option>
   <option value="false" <?php if ($fbstream == 'false') echo 'selected="Hide stream"'; ?> >Hide stream</option>
   </select>
   <br /><small>(<i>Show the profile stream for the public profile.</i>)</small><br />
   <label for="<?php echo  $this->get_field_name('fbheader'); ?>"><b><span style="color:#2680AA;">Header: </span></b></label>
   <select name="<?php echo  $this->get_field_name('fbheader'); ?>" id="<?php echo  $this->get_field_name('fbheader'); ?>">
   <option value="true" <?php if ($fbheader == 'true') echo 'selected="Show Header"'; ?> >Show Header</option>
   <option value="false" <?php if ($fbheader == 'false') echo 'selected="Hide Header"'; ?> >Hide Header</option>
   </select>
   <br /><small>(<i>Show the 'Find us on Facebook' bar at top. Only shown when either stream or faces are present.</i>)</small><br />
   <label for="<?php echo  $this->get_field_name('fbwall'); ?>"><b><span style="color:#2680AA;">Force Wall: </span></b></label>
   <select name="<?php echo  $this->get_field_name('fbwall'); ?>" id="<?php echo  $this->get_field_name('fbwall'); ?>">
   <option value="true" <?php if ($fbheader == 'true') echo 'selected="Yes"'; ?> >Yes</option>
   <option value="false" <?php if ($fbheader == 'false') echo 'selected="No"'; ?> >No</option>
   </select>
   <br /><small>(<i>Force Wall for Places, specifies whether the stream contains posts from the Place's wall or just checkins from friends.</i>)</small><br />
   <label for="<?php echo  $this->get_field_name('fblang'); ?>"><b><span style="color:#2680AA;">Language: </span></b></label><br />
   <select name="<?php echo  $this->get_field_name('fblang'); ?>" id="<?php echo  $this->get_field_name('fblang'); ?>">
        <option value="ca_ES" <?php if ($langlocale == 'ca_ES') echo 'selected="ca_ES"'; ?> >Catalan</option>
		<option value="cs_CZ" <?php if ($langlocale == 'cs_CZ') echo 'selected="cs_CZ"'; ?> >Czech</option>
		<option value="cy_GB" <?php if ($langlocale == 'cy_GB') echo 'selected="cy_GB"'; ?> >Welsh</option>
		<option value="da_DK" <?php if ($langlocale == 'da_DK') echo 'selected="da_DK"'; ?> >Danish</option>
		<option value="de_DE" <?php if ($langlocale == 'de_DE') echo 'selected="de_DE"'; ?> >German</option>
		<option value="eu_ES" <?php if ($langlocale == 'eu_ES') echo 'selected="eu_ES"'; ?> >Basque</option>
		<option value="en_PI" <?php if ($langlocale == 'en_PI') echo 'selected="en_PI"'; ?> >English (Pirate)</option>
		<option value="en_UD" <?php if ($langlocale == 'en_UD') echo 'selected="en_UD"'; ?> >English (Upside Down)</option>
		<option value="ck_US" <?php if ($langlocale == 'ck_US') echo 'selected="ck_US"'; ?> >Cherokee</option>
		<option value="en_US" <?php if ($langlocale == 'en_US') echo 'selected="en_US"'; ?> >English (US)</option>
		<option value="es_LA" <?php if ($langlocale == 'es_LA') echo 'selected="es_LA"'; ?> >Spanish</option>
		<option value="es_CL" <?php if ($langlocale == 'es_CL') echo 'selected="es_CL"'; ?> >Spanish (Chile)</option>
		<option value="es_CO" <?php if ($langlocale == 'es_CO') echo 'selected="es_CO"'; ?> >Spanish (Colombia)</option>
		<option value="es_ES" <?php if ($langlocale == 'es_ES') echo 'selected="es_ES"'; ?> >Spanish (Spain)</option>
		<option value="es_MX" <?php if ($langlocale == 'es_MX') echo 'selected="es_MX"'; ?> >Spanish (Mexico)</option>
		<option value="es_VE" <?php if ($langlocale == 'es_VE') echo 'selected="es_VE"'; ?> >Spanish (Venezuela)</option>
		<option value="fb_FI" <?php if ($langlocale == 'fb_FI') echo 'selected="fb_FI"'; ?> >Finnish (test)</option>
		<option value="fi_FI" <?php if ($langlocale == 'fi_FI') echo 'selected="fi_FI"'; ?> >Finnish</option>
		<option value="fr_FR" <?php if ($langlocale == 'fr_FR') echo 'selected="fr_FR"'; ?> >French (France)</option>
		<option value="gl_ES" <?php if ($langlocale == 'gl_ES') echo 'selected="gl_ES"'; ?> >Galician</option>
		<option value="hu_HU" <?php if ($langlocale == 'hu_HU') echo 'selected="hu_HU"'; ?> >Hungarian</option>
		<option value="it_IT" <?php if ($langlocale == 'it_IT') echo 'selected="it_IT"'; ?> >Italian</option>
		<option value="ja_JP" <?php if ($langlocale == 'ja_JP') echo 'selected="ja_JP"'; ?> >Japanese</option>
		<option value="ko_KR" <?php if ($langlocale == 'ko_KR') echo 'selected="ko_KR"'; ?> >Korean</option>
		<option value="nb_NO" <?php if ($langlocale == 'nb_NO') echo 'selected="nb_NO"'; ?> >Norwegian (bokmal)</option>
		<option value="nn_NO" <?php if ($langlocale == 'nn_NO') echo 'selected="nn_NO"'; ?> >Norwegian (nynorsk)</option>
		<option value="nl_NL" <?php if ($langlocale == 'nl_NL') echo 'selected="nl_NL"'; ?> >Dutch</option>
		<option value="pl_PL" <?php if ($langlocale == 'pl_PL') echo 'selected="pl_PL"'; ?> >Polish</option>
		<option value="pt_BR" <?php if ($langlocale == 'pt_BR') echo 'selected="pt_BR"'; ?> >Portuguese (Brazil)</option>
		<option value="pt_PT" <?php if ($langlocale == 'pt_PT') echo 'selected="pt_PT"'; ?> >Portuguese (Portugal)</option>
		<option value="ro_RO" <?php if ($langlocale == 'ro_RO') echo 'selected="ro_RO"'; ?> >Romanian</option>
		<option value="ru_RU" <?php if ($langlocale == 'ru_RU') echo 'selected="ru_RU"'; ?> >Russian</option>
		<option value="sk_SK" <?php if ($langlocale == 'sk_SK') echo 'selected="sk_SK"'; ?> >Slovak</option>
		<option value="sl_SI" <?php if ($langlocale == 'sl_SI') echo 'selected="sl_SI"'; ?> >Slovenian</option>
		<option value="sv_SE" <?php if ($langlocale == 'sv_SE') echo 'selected="sv_SE"'; ?> >Swedish</option>
		<option value="th_TH" <?php if ($langlocale == 'th_TH') echo 'selected="th_TH"'; ?> >Thai</option>
		<option value="tr_TR" <?php if ($langlocale == 'tr_TR') echo 'selected="tr_TR"'; ?> >Turkish</option>
		<option value="ku_TR" <?php if ($langlocale == 'ku_TR') echo 'selected="ku_TR"'; ?> >Kurdish</option>
        <option value="zh_CN" <?php if ($langlocale == 'zh_CN') echo 'selected="zh_CN"'; ?> >Simplified Chinese (China)</option>
		<option value="zh_HK" <?php if ($langlocale == 'zh_HK') echo 'selected="zh_HK"'; ?> >Traditional Chinese (Hong Kong)</option>
        <option value="zh_TW" <?php if ($langlocale == 'zh_TW') echo 'selected="zh_TW"'; ?> >Traditional Chinese (Taiwan)</option>
        <option value="fb_LT" <?php if ($langlocale == 'fb_LT') echo 'selected="fb_LT"'; ?> >Leet Speak</option>
		<option value="af_ZA" <?php if ($langlocale == 'af_ZA') echo 'selected="af_ZA"'; ?> >Afrikaans</option>
		<option value="sq_AL" <?php if ($langlocale == 'sq_AL') echo 'selected="sq_AL"'; ?> >Albanian</option>
		<option value="hy_AM" <?php if ($langlocale == 'hy_AM') echo 'selected="hy_AM"'; ?> >Armenian</option>
		<option value="az_AZ" <?php if ($langlocale == 'az_AZ') echo 'selected="az_AZ"'; ?> >Azeri</option>
		<option value="be_BY" <?php if ($langlocale == 'be_BY') echo 'selected="be_BY"'; ?> >Belarusian</option>
		<option value="bn_IN" <?php if ($langlocale == 'bn_IN') echo 'selected="bn_IN"'; ?> >Bengali</option>
		<option value="bs_BA" <?php if ($langlocale == 'bs_BA') echo 'selected="bs_BA"'; ?> >Bosnian</option>
		<option value="bg_BG" <?php if ($langlocale == 'bg_BG') echo 'selected="bg_BG"'; ?> >Bulgarian</option>
		<option value="hr_HR" <?php if ($langlocale == 'hr_HR') echo 'selected="hr_HR"'; ?> >Croatian</option>
		<option value="nl_BE" <?php if ($langlocale == 'nl_BE') echo 'selected="nl_BE"'; ?> >Dutch (Belgie)</option>
		<option value="en_GB" <?php if ($langlocale == 'en_GB') echo 'selected="en_GB"'; ?> >English (UK)</option>
		<option value="eo_EO" <?php if ($langlocale == 'eo_EO') echo 'selected="eo_EO"'; ?> >Esperanto</option>
		<option value="et_EE" <?php if ($langlocale == 'et_EE') echo 'selected="et_EE"'; ?> >Estonian</option>
		<option value="fo_FO" <?php if ($langlocale == 'fo_FO') echo 'selected="fo_FO"'; ?> >Faroese</option>
		<option value="fr_CA" <?php if ($langlocale == 'fr_CA') echo 'selected="fr_CA"'; ?> >French (Canada)</option>
		<option value="ka_GE" <?php if ($langlocale == 'ka_GE') echo 'selected="ka_GE"'; ?> >Georgian</option>
		<option value="el_GR" <?php if ($langlocale == 'el_GR') echo 'selected="el_GR"'; ?> >Greek</option>
		<option value="gu_IN" <?php if ($langlocale == 'gu_IN') echo 'selected="gu_IN"'; ?> >Gujarati</option>
		<option value="hi_IN" <?php if ($langlocale == 'hi_IN') echo 'selected="hi_IN"'; ?> >Hindi</option>
        <option value="is_IS" <?php if ($langlocale == 'is_IS') echo 'selected="is_IS"'; ?> >Icelandic</option>
		<option value="id_ID" <?php if ($langlocale == 'id_ID') echo 'selected="id_ID"'; ?> >Indonesian</option>
        <option value="ga_IE" <?php if ($langlocale == 'ga_IE') echo 'selected="ga_IE"'; ?> >Irish</option>
        <option value="jv_ID" <?php if ($langlocale == 'jv_ID') echo 'selected="jv_ID"'; ?> >Javanese</option>
		<option value="kn_IN" <?php if ($langlocale == 'kn_IN') echo 'selected="kn_IN"'; ?> >Kannada</option>
		<option value="kk_KZ" <?php if ($langlocale == 'kk_KZ') echo 'selected="kk_KZ"'; ?> >Kazakh</option>
		<option value="la_VA" <?php if ($langlocale == 'la_VA') echo 'selected="la_VA"'; ?> >Latin</option>
		<option value="lv_LV" <?php if ($langlocale == 'lv_LV') echo 'selected="lv_LV"'; ?> >Latvian</option>
		<option value="li_NL" <?php if ($langlocale == 'li_NL') echo 'selected="li_NL"'; ?> >Limburgish</option>
		<option value="lt_LT" <?php if ($langlocale == 'lt_LT') echo 'selected="lt_LT"'; ?> >Lithuanian</option>
		<option value="mk_MK" <?php if ($langlocale == 'mk_MK') echo 'selected="mk_MK"'; ?> >Macedonian</option>
		<option value="mg_MG" <?php if ($langlocale == 'mg_MG') echo 'selected="mg_MG"'; ?> >Malagasy</option>
		<option value="ms_MY" <?php if ($langlocale == 'ms_MY') echo 'selected="ms_MY"'; ?> >Malay</option>
		<option value="mt_MT" <?php if ($langlocale == 'mt_MT') echo 'selected="mt_MT"'; ?> >Maltese</option>
		<option value="mr_IN" <?php if ($langlocale == 'mr_IN') echo 'selected="mr_IN"'; ?> >Marathi</option>
		<option value="mn_MN" <?php if ($langlocale == 'mn_MN') echo 'selected="mn_MN"'; ?> >Mongolian</option>
		<option value="ne_NP" <?php if ($langlocale == 'ne_NP') echo 'selected="ne_NP"'; ?> >Nepali</option>
		<option value="pa_IN" <?php if ($langlocale == 'pa_IN') echo 'selected="pa_IN"'; ?> >Punjabi</option>
		<option value="rm_CH" <?php if ($langlocale == 'rm_CH') echo 'selected="rm_CH"'; ?> >Romansh</option>
		<option value="sa_IN" <?php if ($langlocale == 'sa_IN') echo 'selected="sa_IN"'; ?> >Sanskrit</option>
		<option value="sr_RS" <?php if ($langlocale == 'sr_RS') echo 'selected="sr_RS"'; ?> >Serbian</option>
		<option value="so_SO" <?php if ($langlocale == 'so_SO') echo 'selected="so_SO"'; ?> >Somali</option>
		<option value="sw_KE" <?php if ($langlocale == 'sw_KE') echo 'selected="sw_KE"'; ?> >Swahili</option>
        <option value="tl_PH" <?php if ($langlocale == 'tl_PH') echo 'selected="tl_PH"'; ?> >Filipino</option>
		<option value="ta_IN" <?php if ($langlocale == 'ta_IN') echo 'selected="ta_IN"'; ?> >Tamil</option>
        <option value="tt_RU" <?php if ($langlocale == 'tt_RU') echo 'selected="tt_RU"'; ?> >Tatar</option>
        <option value="te_IN" <?php if ($langlocale == 'te_IN') echo 'selected="te_IN"'; ?> >Telugu</option>
		<option value="ml_IN" <?php if ($langlocale == 'ml_IN') echo 'selected="ml_IN"'; ?> >Malayalam</option>
		<option value="uk_UA" <?php if ($langlocale == 'uk_UA') echo 'selected="uk_UA"'; ?> >Ukrainian</option>
		<option value="uz_UZ" <?php if ($langlocale == 'uz_UZ') echo 'selected="uz_UZ"'; ?> >Uzbek</option>
		<option value="vi_VN" <?php if ($langlocale == 'vi_VN') echo 'selected="vi_VN"'; ?> >Vietnamese</option>
		<option value="xh_ZA" <?php if ($langlocale == 'xh_ZA') echo 'selected="xh_ZA"'; ?> >Xhosa</option>
		<option value="zu_ZA" <?php if ($langlocale == 'zu_ZA') echo 'selected="zu_ZA"'; ?> >Zulu</option>
		
		<option value="tg_TJ" <?php if ($langlocale == 'tg_TJ') echo 'selected="tg_TJ"'; ?> >Tajik</option>
		<option value="ar_AR" <?php if ($langlocale == 'ar_AR') echo 'selected="ar_AR"'; ?> >Arabic</option>
		<option value="he_IL" <?php if ($langlocale == 'he_IL') echo 'selected="he_IL"'; ?> >Hebrew</option>
		<option value="ur_PK" <?php if ($langlocale == 'ur_PK') echo 'selected="ur_PK"'; ?> >Urdu</option>
		<option value="fa_IR" <?php if ($langlocale == 'fa_IR') echo 'selected="fa_IR"'; ?> >Persian</option>
		<option value="sy_SY" <?php if ($langlocale == 'sy_SY') echo 'selected="sy_SY"'; ?> >Syriac</option>
		<option value="yi_DE" <?php if ($langlocale == 'yi_DE') echo 'selected="yi_DE"'; ?> >Yiddish</option>
		<option value="gn_PY" <?php if ($langlocale == 'gn_PY') echo 'selected="gn_PY"'; ?> >Guarani</option>
		<option value="qu_PE" <?php if ($langlocale == 'qu_PE') echo 'selected="qu_PE"'; ?> >Quechua</option>
		<option value="ay_BO" <?php if ($langlocale == 'ay_BO') echo 'selected="ay_BO"'; ?> >Aymara</option>
		<option value="se_NO" <?php if ($langlocale == 'se_NO') echo 'selected="se_NO"'; ?> >Northern Sami</option>
		<option value="ps_AF" <?php if ($langlocale == 'ps_AF') echo 'selected="ps_AF"'; ?> >Pashto</option>
 		<option value="tl_ST" <?php if ($langlocale == 'tl_ST') echo 'selected="tl_ST"'; ?> >Klingon</option>
   </select>
   <br /><small>(<i>The language of likebox.</i>)</small><br />
   <label for="<?php echo  $this->get_field_name('customclass'); ?>"><b><span style="color:#2680AA;">CSS class: </span></b></label>
   <input name="<?php echo  $this->get_field_name('customclass'); ?>" id="<?php echo  $this->get_field_name('customclass'); ?>" value="<?php echo $customclass; ?>" size="7"   type="text">&nbsp;name.
   <br /><small>(<i>Optional, if need to customize backround of likebox or something..</i>)</small><br />
   <hr style=" border:#2680AA 1px solid;">

<?php
	} //end of form

}// END class


	function wppluginFacebookLikeBoxInit() {
	register_widget('BestFacebookLikeBoxWidget');
	}	
	add_action('widgets_init', 'wppluginFacebookLikeBoxInit');
?>