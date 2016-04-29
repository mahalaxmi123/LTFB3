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

/**
 * Parses CSS before it is cached.
 *
 * This function can make alterations and replace patterns within the CSS.
 *
 * @param string $css The CSS
 * @param theme_config $theme The theme config object.
 * @return string The parsed CSS The parsed CSS.
 */
function theme_galaxy_process_css($css, $theme) {

    // Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = theme_galaxy_set_logo($css, $logo);

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_galaxy_set_customcss($css, $customcss);

    return $css;
}

/**
 * Adds the logo to CSS.
 *
 * @param string $css The CSS.
 * @param string $logo The URL of the logo.
 * @return string The parsed CSS
 */
function theme_galaxy_set_logo($css, $logo) {
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_galaxy_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        $theme = theme_config::load('galaxy');
        // By default, theme files must be cache-able by both browsers and proxies.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        if ($filearea === 'logo') {
            return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage1') {
            return $theme->setting_file_serve('bannerimage1', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage2') {
            return $theme->setting_file_serve('bannerimage2', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage3') {
            return $theme->setting_file_serve('bannerimage3', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage4') {
            return $theme->setting_file_serve('bannerimage4', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage5') {
            return $theme->setting_file_serve('bannerimage5', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage6') {
            return $theme->setting_file_serve('bannerimage6', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage7') {
            return $theme->setting_file_serve('bannerimage7', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage8') {
            return $theme->setting_file_serve('bannerimage8', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage9') {
            return $theme->setting_file_serve('bannerimage9', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage10') {
            return $theme->setting_file_serve('bannerimage10', $args, $forcedownload, $options);
        } else {
            send_file_not_found();
        }
    } else {
        send_file_not_found();
    }
}

/**
 * Adds any custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_galaxy_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Returns an object containing HTML for the areas affected by settings.
 *
 * Do not add Galaxy specific logic in here, child themes should be able to
 * rely on that function just by declaring settings with similar names.
 *
 * @param renderer_base $output Pass in $OUTPUT.
 * @param moodle_page $page Pass in $PAGE.
 * @return stdClass An object with the following properties:
 *      - navbarclass A CSS class to use on the navbar. By default ''.
 *      - heading HTML to use for the heading. A logo if one is selected or the default heading.
 *      - footnote HTML to use as a footnote. By default ''.
 */
function theme_galaxy_get_html_for_settings(renderer_base $output, moodle_page $page) {
    global $CFG;
    $return = new stdClass;
    
    $return->navbarclass = '';
    if (!empty($page->theme->settings->invert)) {
        $return->navbarclass .= ' navbar-inverse';
    }
    
    // Only display the logo on the front page and login page, if one is defined.
    if (!empty($page->theme->settings->logo)) {
        $logolink = html_writer::link($CFG->wwwroot, '&nbsp;');
        $return->heading = html_writer::tag('div', $logolink, array('class' => 'logo'));
    } else {
        $return->heading = $output->page_heading();
    }
 
    
    $return->footnote = '';
    if (!empty($page->theme->settings->footnote)) {
        $return->footnote = '<div class="footnote text-center">'.format_text($page->theme->settings->footnote).'</div>';
    }

    return $return;
}

/**
 * Display Footer Block Custom Links
 * @param string $menu_name Footer block link name.
 * @return string The Footer links are return.
 */
function theme_galaxy_generate_links($menuname = '') {
    global $CFG, $PAGE;
    $htmlstr = '';
    $menustr = theme_galaxy_get_setting($menuname);
    $menusettings = explode("\n", $menustr);
    foreach ($menusettings as $menukey => $menuval) {
        $expset = explode("|", $menuval);
       
        $ltxt =$expset[0];
        $ltxt = trim($ltxt);
        if (empty($ltxt)) {
            continue;
        }
        if (empty($lurl)) {
            $lurl = 'javascript:void(0);';
        }

        $pos = strpos($lurl, 'http');
        if ($pos === false) {
            $lurl = new moodle_url($lurl);
        }
        $htmlstr .= '<li><a href="'.$lurl.'">'.$ltxt.'</a></li>'."\n";
    }

    return $htmlstr;
}

/**
 * Get setting format
 */
function theme_galaxy_get_setting($setting, $format = false) {
    global $CFG;
    require_once($CFG->dirroot . '/lib/weblib.php');
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('galaxy');
    }
    if (empty($theme->settings->$setting)) {
        return false;
    } else if (!$format) {
        return $theme->settings->$setting;
    } else if ($format === 'format_text') {
        return format_text($theme->settings->$setting, FORMAT_PLAIN);
    } else if ($format === 'format_html') {
        return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
    } else {
        return format_string($theme->settings->$setting);
    }
}

/**
 * All theme functions should start with theme_galaxy_
 * @deprecated since 2.5.1
 */
function theme_galaxy_course_trim_char($str, $n = 500, $endchar = '&#8230;') {
    if (strlen($str) < $n) {
        return $str;
    }

    $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));
    if (strlen($str) <= $n) {
        return $str;
    }

    $out = "";
    $small = substr($str, 0, $n);
    $out = $small.$endchar;
    return $out;
}

function theme_galaxy_lang($key = '') {
    $pos = strpos($key, 'lang:');
    if ($pos !== false) {
        list($l, $k) = explode(":", $key);
        $v = get_string($k, 'theme_galaxy');
        return $v;
    } else {
        return $key;
    }

}

function galaxy_process_css() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

/**
 * All theme functions should start with theme_galaxy_
 * @deprecated since 2.5.1
 */
function galaxy_set_logo() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

/**
 * All theme functions should start with theme_galaxy_
 * @deprecated since 2.5.1
 */
function galaxy_set_customcss() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

function theme_galaxy_page_init(moodle_page $page) {
    $page->requires->jquery();
}