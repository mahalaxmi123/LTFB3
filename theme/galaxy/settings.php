<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Moodle's Galaxy theme, an example of how to make a Bootstrap theme
 *
 * DO NOT MODIFY THIS THEME!
 * COPY IT FIRST, THEN RENAME THE COPY AND MODIFY IT INSTEAD.
 *
 * For full information about creating Moodle themes, see:
 * http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   theme_galaxy
 * @copyright 2013 Moodle, moodle.org
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$settings = null;

defined('MOODLE_INTERNAL') || die;
global $PAGE;{

$ADMIN->add('themes', new admin_category('theme_galaxy', 'Galaxy'));

/* General Settings */
    $temp = new admin_settingpage('theme_galaxy_generic',  get_string('geneicsettings', 'theme_galaxy'));
    
    // Logo file setting.
    $name = 'theme_galaxy/logo';
    $title = get_string('logo','theme_galaxy');
    $description = get_string('logodesc', 'theme_galaxy');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Custom CSS file.
    $name = 'theme_galaxy/customcss';
    $title = get_string('customcss', 'theme_galaxy');
    $description = get_string('customcssdesc', 'theme_galaxy');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Invert Navbar to dark background.
    $name = 'theme_galaxy/invert';
    $title = get_string('invert', 'theme_galaxy');
    $description = get_string('invertdesc', 'theme_galaxy');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $ADMIN->add('theme_galaxy', $temp);
    
    
/* Banner Settings */
    $temp = new admin_settingpage('theme_galaxy_banner', get_string('bannersettings', 'theme_galaxy'));
    
    $temp->add(new admin_setting_heading('theme_galaxy_banner', get_string('bannersettingssub', 'theme_galaxy'),
            format_text(get_string('bannersettingsdesc' , 'theme_galaxy'), FORMAT_MARKDOWN)));
			
	// Set Number of Slides.
    $name = 'theme_galaxy/slidenumber';
    $title = get_string('slidenumber' , 'theme_galaxy');
    $description = get_string('slidenumberdesc', 'theme_galaxy');
    $default = '1';
    $choices = array(
        '0'=>'0',
    	'1'=>'1',
    	'2'=>'2',
    	'3'=>'3',
    	'4'=>'4',
    	'5'=>'5',
    	'6'=>'6',
    	'7'=>'7',
    	'8'=>'8',
    	'9'=>'9',
    	'10'=>'10');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Set the Slide Speed.
    $name = 'theme_galaxy/slidespeed';
    $title = get_string('slidespeed' , 'theme_galaxy');
    $description = get_string('slidespeeddesc', 'theme_galaxy');
    $default = '600';
    $setting = new admin_setting_configtext($name, $title, $description, $default );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $hasslidenum = (!empty($PAGE->theme->settings->slidenumber));
    if ($hasslidenum) {
            $slidenum = $PAGE->theme->settings->slidenumber;
	} else {
            $slidenum = '1';
	}

	$bannertitle = array('Slide One', 'Slide Two', 'Slide Three','Slide Four','Slide Five','Slide Six','Slide Seven', 'Slide Eight', 'Slide Nine', 'Slide Ten');

    foreach (range(1, $slidenum) as $bannernumber) {

    	// This is the descriptor for the Banner Settings.
    	$name = 'theme_galaxy/banner';
        $title = get_string('bannerindicator', 'theme_galaxy');
    	$information = get_string('bannerindicatordesc', 'theme_galaxy');
    	$setting = new admin_setting_heading($name.$bannernumber, $title.$bannernumber, $information);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

        // Enables the slide.
        $name = 'theme_galaxy/enablebanner' . $bannernumber;
        $title = get_string('enablebanner', 'theme_galaxy', $bannernumber);
        $description = get_string('enablebannerdesc', 'theme_galaxy', $bannernumber);
        $default = false;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide Title.
        $name = 'theme_galaxy/bannertitle' . $bannernumber;
        $title = get_string('bannertitle', 'theme_galaxy', $bannernumber);
        $description = get_string('bannertitledesc', 'theme_galaxy', $bannernumber);
        $default = $bannertitle[$bannernumber - 1];
        $setting = new admin_setting_configtext($name, $title, $description, $default );
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide text.
        $name = 'theme_galaxy/bannertext' . $bannernumber;
        $title = get_string('bannertext', 'theme_galaxy', $bannernumber);
        $description = get_string('bannertextdesc', 'theme_galaxy', $bannernumber);
        $default = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel tincidunt dolor. Aenean vel tellus consequat, euismod mi at, maximus ex. Donec quis sagittis turpis, id feugiat metus.';
        $setting = new admin_setting_configtextarea($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Text for Slide Link.
        $name = 'theme_galaxy/bannerlinktext' . $bannernumber;
        $title = get_string('bannerlinktext', 'theme_galaxy', $bannernumber);
        $description = get_string('bannerlinktextdesc', 'theme_galaxy', $bannernumber);
        $default = 'Read More';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Destination URL for Slide Link
        $name = 'theme_galaxy/bannerlinkurl' . $bannernumber;
        $title = get_string('bannerlinkurl', 'theme_galaxy', $bannernumber);
        $description = get_string('bannerlinkurldesc', 'theme_galaxy', $bannernumber);
        $default = '#';
        $previewconfig = null;
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide Image.
    	$name = 'theme_galaxy/bannerimage' . $bannernumber;
    	$title = get_string('bannerimage', 'theme_galaxy', $bannernumber);
    	$description = get_string('bannerimagedesc', 'theme_galaxy', $bannernumber);
    	$setting = new admin_setting_configstoredfile($name, $title, $description, 'bannerimage'.$bannernumber);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);
    }

    $ADMIN->add('theme_galaxy', $temp); 
    
    
/* Social Network Settings 
$temp = new admin_settingpage('theme_galaxy_social', get_string('socialsettings', 'theme_galaxy'));
    $temp->add(new admin_setting_heading('theme_galaxy_social', get_string('socialheadingsub', 'theme_galaxy'),
        format_text(get_string('socialdesc', 'theme_galaxy'), FORMAT_MARKDOWN)));

    // Facebook url setting.
    $name = 'theme_galaxy/facebook';
    $title = get_string('facebook', 'theme_galaxy');
    $description = get_string('facebookdesc', 'theme_galaxy');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Flickr url setting.
    $name = 'theme_galaxy/flickr';
    $title = get_string('flickr', 'theme_galaxy');
    $description = get_string('flickrdesc', 'theme_galaxy');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Twitter url setting.
    $name = 'theme_galaxy/twitter';
    $title = get_string('twitter', 'theme_galaxy');
    $description = get_string('twitterdesc', 'theme_galaxy');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // LinkedIn url setting.
    $name = 'theme_galaxy/linkedin';
    $title = get_string('linkedin', 'theme_galaxy');
    $description = get_string('linkedindesc', 'theme_galaxy');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Pinterest url setting.
    $name = 'theme_galaxy/pinterest';
    $title = get_string('pinterest', 'theme_galaxy');
    $description = get_string('pinterestdesc', 'theme_galaxy');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // YouTube url setting.
    $name = 'theme_galaxy/youtube';
    $title = get_string('youtube', 'theme_galaxy');
    $description = get_string('youtubedesc', 'theme_galaxy');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
    
    $ADMIN->add('theme_galaxy', $temp);
   */ 
    $temp = new admin_settingpage('theme_galaxy_footer', get_string('footersettings', 'theme_galaxy'));
    $temp->add(new admin_setting_heading('theme_galaxy_footer', get_string('footerheadingsub', 'theme_galaxy'),
        format_text(get_string('footerdesc', 'theme_galaxy'), FORMAT_MARKDOWN)));
    /* Footer Content */
    
    $name = 'theme_galaxy/footer1header';
    $title = get_string('footer1header', 'theme_galaxy');
    $description = get_string('footer1desc', 'theme_galaxy');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
    
    
    $name = 'theme_galaxy/footerblock1link';
    $title = get_string('footerblock1link', 'theme_galaxy');
    $description = get_string('footerblock1linkdesc', 'theme_galaxy');
    //$default = get_string('footerblock1link_default', 'theme_galaxy');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
//    $name = 'theme_galaxy/footerblock1link';
//    $title = get_string('footerblock1link', 'theme_galaxy');
//    $description = get_string('footerblock1linkdesc','theme_galaxy');
//    $default = get_string('footerblock1link', 'theme_galaxy');
//    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
//    $setting->set_updatedcallback('theme_reset_all_caches');
//    $temp->add($setting);
    
        /* More Info*/
    $name = 'theme_galaxy/footer2header';
    $title = get_string('footer2header', 'theme_galaxy');
    $description = get_string('footer2headerdesc','theme_galaxy');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
    
    $name = 'theme_galaxy/footnote';
    $title = get_string('footnote', 'theme_galaxy');
    $description = get_string('footnotedesc', 'theme_galaxy');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting); 
    
    
    $name = 'theme_galaxy/footer3header';
    $title = get_string('footer3header', 'theme_galaxy');
    $description = get_string('footer3headerdesc','theme_galaxy');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
    
    /* Address , Email , Phone No */		
    $name = 'theme_galaxy/address';
    $title = get_string('address', 'theme_galaxy');
    $description = '';
    $default = get_string('defaultaddress','theme_galaxy');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
				
				
    $name = 'theme_galaxy/emailid';
    $title = get_string('emailid', 'theme_galaxy');
    $description = '';
    $default = get_string('defaultemailid','theme_galaxy');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
				
    $name = 'theme_galaxy/phoneno';
    $title = get_string('phoneno', 'theme_galaxy');
    $description = '';
    $default = get_string('defaultphoneno','theme_galaxy');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
    
   $name = 'theme_galaxy/copyright_footer';
    $title = get_string('copyright_footer', 'theme_galaxy');
    $description = '';
    $default = get_string('copyright_default','theme_galaxy');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
    
    
     
    $ADMIN->add('theme_galaxy', $temp);    
}   