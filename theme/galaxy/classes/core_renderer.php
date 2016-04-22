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

require_once($CFG->dirroot . '/theme/bootstrapbase/renderers.php');

/**
 * Galaxy core renderers.
 *
 * @package    theme_galaxy
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_galaxy_core_renderer extends theme_bootstrapbase_core_renderer {

    /**
     * Either returns the parent version of the header bar, or a version with the logo replacing the header.
     *
     * @since Moodle 2.9
     * @param array $headerinfo An array of header information, dependant on what type of header is being displayed. The following
     *                          array example is user specific.
     *                          heading => Override the page heading.
     *                          user => User object.
     *                          usercontext => user context.
     * @param int $headinglevel What level the 'h' tag will be.
     * @return string HTML for the header bar.
     */
    public function context_header($headerinfo = null, $headinglevel = 1) {
        global $CFG;
        if ($this->should_render_logo($headinglevel)) {
            $logolink = html_writer::link($CFG->wwwroot, '&nbsp;');
            $logoheader = html_writer::start_tag('div', array('class' => 'header-in'));
            $logoheader .= html_writer::start_tag('div', array('class' => 'container-fluid'));
            $logoheader .= html_writer::tag('div', $logolink, array('class' => 'logo'));
            $logoheader .= html_writer::end_tag('div');
            $logoheader .= html_writer::end_tag('div');
            return $logoheader;
        }
        return parent::context_header($headerinfo, $headinglevel);
    }

    /**
     * Determines if we should render the logo.
     *
     * @param int $headinglevel What level the 'h' tag will be.
     * @return bool Should the logo be rendered.
     */
    protected function should_render_logo($headinglevel = 1) {
        global $PAGE;

        // Only render the logo if we're on the front page or login page
        // and the theme has a logo.
        if ($headinglevel == 1 && !empty($this->page->theme->settings->logo)) {
            return true;
        }

        return false;
    }
    
    /**
     * Wrapper for header elements.
     *
     * @return string HTML to display the main header.
     */
    public function full_header() {
        $html = html_writer::start_tag('header', array('id' => 'page-header', 'class' => 'clearfix'));
       // $html .= $this->context_header();
        $html .= html_writer::start_div('container-fluid', array('id' => 'page-navbar'));
        $html .= html_writer::tag('nav', $this->navbar(), array('class' => 'breadcrumb-nav'));
        $html .= html_writer::div($this->page_heading_button(), 'breadcrumb-button');
        $html .= html_writer::end_div();
        $html .= html_writer::tag('div', $this->course_header(), array('id' => 'course-header'));
        $html .= html_writer::end_tag('header');
        return $html;
    }
    
    public function render_social_network($socialnetwork) {
        if (theme_galaxy_get_setting($socialnetwork)) {
            $icon = $socialnetwork;
            $socialhtml = html_writer::start_tag('a', array(
                'class' => $socialnetwork,
                'onclick' => "window.open('" . theme_galaxy_get_setting($socialnetwork) . "')",
                'title' => get_string($socialnetwork, 'theme_galaxy'),
            ));
            $socialhtml .= html_writer::start_tag('i', array('class' => 'fa fa-'.$icon.'-square'));
            $socialhtml .= html_writer::end_tag('i');
            $socialhtml .= html_writer::start_span('sr-only') . html_writer::end_span();
            $socialhtml .= html_writer::end_tag('a');

            return $socialhtml;

        } else {
            return false;
        }
    }
}
