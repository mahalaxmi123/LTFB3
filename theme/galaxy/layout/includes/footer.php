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
 * The maintenance layout.
 *
 * @package   theme_galaxy
 * @copyright 2015 Nephzat Dev Team,nephzat.com
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$footnote = theme_galaxy_get_setting('footnote', 'format_html');
$footer1header = theme_galaxy_get_setting('footer1header', 'format_text');
$footer1header = theme_galaxy_lang($footer1header);

$footerblock1link = theme_galaxy_get_setting('footerblock1link');
$footerblock1link = theme_galaxy_generate_links('footerblock1link');



$footer2header = theme_galaxy_get_setting('footer2header', 'format_text');
$footer2header = theme_galaxy_lang($footer2header);

$footer3header = theme_galaxy_get_setting('footer3header', 'format_text');
$footer3header = theme_galaxy_lang($footer3header);


$address  = theme_galaxy_get_setting('address');
$emailid  = theme_galaxy_get_setting('emailid');
$phoneno  = theme_galaxy_get_setting('phoneno');
$copyright_footer = theme_galaxy_get_setting('copyright_footer');

$footerbtitle = theme_galaxy_get_setting('footerbtitle', 'format_text');

?>


<footer id="footer">    
  <div class="footer-main">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
            <div class="footer-nav">
            <h1> <?php echo $footer1header; ?></h1>
                <ul>                        	
                     <?php echo theme_galaxy_generate_links('footerblock1link'); ?>  
                </ul>
             </div>
        </div>
          
         <div class="span5">
          <div class="footer-desc">
            <h1><?php echo $footer2header; ?></h1>        	
             <p><?php echo $footnote; ?>
           </div>
        </div> 
          
        <div class="span4">
            <div class="contact-info">
                 <h1><?php echo $footer3header; ?></h1> 
                <p><?php echo $address; ?><br>
                <i class="fa fa-phone-square"></i>Phone: <?php echo $phoneno; ?><br>
                <i class="fa fa-envelope"></i>E-mail: <a class="mail-link" href="mailto:<?php echo $emailid; ?>"><?php echo $emailid; ?></a>
                </p>
            </div> 
        </div>
      </div>
    </div>
  </div>
  <div class="footer-foot">
  	<div class="container-fluid">
	  	 <?php if ($copyright_footer): ?>
      	<p><?php echo $copyright_footer; ?></p>
       <?php endif; ?>
    </div>
  </div>
</footer>
<!--E.O.Footer-->

 <?php  echo $OUTPUT->standard_end_of_body_html() ?>