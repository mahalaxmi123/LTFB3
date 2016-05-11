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
 * Moodle's Medilearn theme, an example of how to make a Bootstrap theme
 *
 * DO NOT MODIFY THIS THEME!
 * COPY IT FIRST, THEN RENAME THE COPY AND MODIFY IT INSTEAD.
 *
 * For full information about creating Moodle themes, see:
 * http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   theme_medilearn
 * @copyright 2013 Moodle, moodle.org
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$settings = null;

defined('MOODLE_INTERNAL') || die;
global $PAGE;

$ADMIN->add('themes', new admin_category('theme_medilearn', 'Medilearn'));

/* General Settings */
    $temp = new admin_settingpage('theme_medilearn_generic',  get_string('geneicsettings', 'theme_medilearn'));

    // Invert Navbar to dark background.
    $name = 'theme_medilearn/invert';
    $title = get_string('invert', 'theme_medilearn');
    $description = get_string('invertdesc', 'theme_medilearn');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Logo file setting.
    $name = 'theme_medilearn/logo';
    $title = get_string('logo','theme_medilearn');
    $description = get_string('logodesc', 'theme_medilearn');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Custom CSS file.
    $name = 'theme_medilearn/customcss';
    $title = get_string('customcss', 'theme_medilearn');
    $description = get_string('customcssdesc', 'theme_medilearn');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_medilearn/footnote';
    $title = get_string('footnote', 'theme_medilearn');
    $description = get_string('footnotedesc', 'theme_medilearn');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_medilearn/footnote';
    $title = get_string('footnote', 'theme_medilearn');
    $description = get_string('footnotedesc', 'theme_medilearn');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting); 
    
    

	$ADMIN->add('theme_medilearn', $temp);
    
    /* Banner Settings */
    $temp = new admin_settingpage('theme_medilearn_banner', get_string('bannersettings', 'theme_medilearn'));
    
    $temp->add(new admin_setting_heading('theme_medilearn_banner', get_string('bannersettingssub', 'theme_medilearn'),
            format_text(get_string('bannersettingsdesc' , 'theme_medilearn'), FORMAT_MARKDOWN)));
			
	// Set Number of Slides.
    $name = 'theme_medilearn/slidenumber';
    $title = get_string('slidenumber' , 'theme_medilearn');
    $description = get_string('slidenumberdesc', 'theme_medilearn');
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
    $name = 'theme_medilearn/slidespeed';
    $title = get_string('slidespeed' , 'theme_medilearn');
    $description = get_string('slidespeeddesc', 'theme_medilearn');
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
    	$name = 'theme_medilearn/banner';
        $title = get_string('bannerindicator', 'theme_medilearn');
    	$information = get_string('bannerindicatordesc', 'theme_medilearn');
    	$setting = new admin_setting_heading($name.$bannernumber, $title.$bannernumber, $information);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

        // Enables the slide.
        $name = 'theme_medilearn/enablebanner' . $bannernumber;
        $title = get_string('enablebanner', 'theme_medilearn', $bannernumber);
        $description = get_string('enablebannerdesc', 'theme_medilearn', $bannernumber);
        $default = false;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide Title.
        $name = 'theme_medilearn/bannertitle' . $bannernumber;
        $title = get_string('bannertitle', 'theme_medilearn', $bannernumber);
        $description = get_string('bannertitledesc', 'theme_medilearn', $bannernumber);
        $default = $bannertitle[$bannernumber - 1];
        $setting = new admin_setting_configtext($name, $title, $description, $default );
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide text.
        $name = 'theme_medilearn/bannertext' . $bannernumber;
        $title = get_string('bannertext', 'theme_medilearn', $bannernumber);
        $description = get_string('bannertextdesc', 'theme_medilearn', $bannernumber);
        $default = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel tincidunt dolor. Aenean vel tellus consequat, euismod mi at, maximus ex. Donec quis sagittis turpis, id feugiat metus.';
        $setting = new admin_setting_configtextarea($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Text for Slide Link.
        $name = 'theme_medilearn/bannerlinktext' . $bannernumber;
        $title = get_string('bannerlinktext', 'theme_medilearn', $bannernumber);
        $description = get_string('bannerlinktextdesc', 'theme_medilearn', $bannernumber);
        $default = 'Read More';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Destination URL for Slide Link
        $name = 'theme_medilearn/bannerlinkurl' . $bannernumber;
        $title = get_string('bannerlinkurl', 'theme_medilearn', $bannernumber);
        $description = get_string('bannerlinkurldesc', 'theme_medilearn', $bannernumber);
        $default = '#';
        $previewconfig = null;
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide Image.
    	$name = 'theme_medilearn/bannerimage' . $bannernumber;
    	$title = get_string('bannerimage', 'theme_medilearn', $bannernumber);
    	$description = get_string('bannerimagedesc', 'theme_medilearn', $bannernumber);
    	$setting = new admin_setting_configstoredfile($name, $title, $description, 'bannerimage'.$bannernumber);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);
    }

    $ADMIN->add('theme_medilearn', $temp); 
    
    /* Social Network Settings */
$temp = new admin_settingpage('theme_medilearn_social', get_string('socialsettings', 'theme_medilearn'));
    $temp->add(new admin_setting_heading('theme_medilearn_social', get_string('socialheadingsub', 'theme_medilearn'),
        format_text(get_string('socialdesc', 'theme_medilearn'), FORMAT_MARKDOWN)));

    // Facebook url setting.
    $name = 'theme_medilearn/facebook';
    $title = get_string('facebook', 'theme_medilearn');
    $description = get_string('facebookdesc', 'theme_medilearn');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Flickr url setting.
    $name = 'theme_medilearn/flickr';
    $title = get_string('flickr', 'theme_medilearn');
    $description = get_string('flickrdesc', 'theme_medilearn');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Twitter url setting.
    $name = 'theme_medilearn/twitter';
    $title = get_string('twitter', 'theme_medilearn');
    $description = get_string('twitterdesc', 'theme_medilearn');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // LinkedIn url setting.
    $name = 'theme_medilearn/linkedin';
    $title = get_string('linkedin', 'theme_medilearn');
    $description = get_string('linkedindesc', 'theme_medilearn');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Pinterest url setting.
    $name = 'theme_medilearn/pinterest';
    $title = get_string('pinterest', 'theme_medilearn');
    $description = get_string('pinterestdesc', 'theme_medilearn');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // YouTube url setting.
    $name = 'theme_medilearn/youtube';
    $title = get_string('youtube', 'theme_medilearn');
    $description = get_string('youtubedesc', 'theme_medilearn');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
    
    $ADMIN->add('theme_medilearn', $temp);
