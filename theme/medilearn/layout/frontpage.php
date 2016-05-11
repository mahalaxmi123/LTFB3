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

// Get the HTML for the settings bits.
$html = theme_medilearn_get_html_for_settings($OUTPUT, $PAGE);

$hasslidespeed = (empty($PAGE->theme->settings->slidespeed)) ? false : $PAGE->theme->settings->slidespeed;
if ($hasslidespeed) {
	$slidespeed = $hasslidespeed;
} else {
	$slidespeed = '200';
}

// Set default (LTR) layout mark-up for a three column page.
$regionmainbox = 'span9';
$regionmain = 'span8 pull-right';
$sidepre = 'span4 desktop-first-column';
$sidepost = 'span3 pull-right';
// Reset layout mark-up for RTL languages.
if (right_to_left()) {
    $regionmainbox = 'span9 pull-right';
    $regionmain = 'span8';
    $sidepre = 'span4 pull-right';
    $sidepost = 'span3 desktop-first-column';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<div id="page-wrapper">
    <div id="top-header">
        <div class="container">
            <div class="row-fluid">
                <div class="span6"> 
				<?php require_once(dirname(__FILE__).'/includes/socialicons.php'); ?>

                </div>
                <div class="span6">
                  <?php echo $OUTPUT->user_menu(); ?> 
                </div>   
            </div>
        </div>
    </div>
    
    <div id="header-wrapper">
        <div class="bottom-header">   
            <div  class="navbar container<?php echo $html->navbarclass ?> moodle-has-zindex">
                 <?php echo $html->heading; ?> 
                <nav class="navigation"> 
                    
                        <a class="brand" href="<?php echo $CFG->wwwroot;?>"><?php echo
                            format_string($SITE->shortname, true, array('context' => context_course::instance(SITEID)));
                            ?></a>
                    <?php echo $OUTPUT->navbar_button(); ?>
                        <div class="nav-collapse collapse">
                          <?php echo $OUTPUT->custom_menu(); ?>     
                            <ul class="nav pull-right"> 
							     <li><?php echo $OUTPUT->page_heading_menu(); ?></li>

                            </ul>
                        </div>
                   
                </nav>
            </div>          
        </div>
    </div>
    
    
     <!-- Start Slideshow -->
<?php require_once(dirname(__FILE__).'/includes/slideshow.php'); ?>
<!-- End -->

    
    <div id="page" class="container">
     
        <?php //echo $OUTPUT->full_header(); ?>
         
            <div id="page-content" class="row-fluid">
                <div id="region-main-box" class="<?php echo $regionmainbox; ?>">
                    <div class="row-fluid">
                        <section id="region-main" class="<?php echo $regionmain; ?>">
                            <?php
                            echo $OUTPUT->course_content_header();
                            echo $OUTPUT->main_content();
                            echo $OUTPUT->course_content_footer();
                            ?>
                        </section>
                        <?php echo $OUTPUT->blocks('side-pre', $sidepre); ?>
                    </div>
                </div>
                <?php echo $OUTPUT->blocks('side-post', $sidepost); ?>
            </div>
 
        </div>

    <footer id="page-footer">
        <div class="footer-in">
            <div class="container">
                    <div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>
                    <div class="row-fluid">
                        <div class="copyright-box"><?php echo $html->footnote; ?></div>
                        <?php echo $OUTPUT->standard_end_of_body_html() ?>
                    </div>
            </div>
        </div>

        <div id="footer"> 
            <?php echo $OUTPUT->standard_footer_html(); ?>
        </div>
        
    </footer>
</div>
</body>
</html>
