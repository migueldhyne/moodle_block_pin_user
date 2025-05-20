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
 * Block definition class for the block_pluginname plugin.
 *
 * @package   block_pin_user
 * @copyright 2025, Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

/**
 * Block plugin to display pinned user information on the course participants page.
 *
 * This block shows a list of enrolled users in a course along with customized
 * badges based on specific user profile fields. It is only visible to users who
 * have the capability to manage course activities and is only displayed on the
 * participants page.
 */
class block_pin_user extends block_base {

    /**
     * Initializes the block's title using the localized plugin name.
     *
     * This method is called when the block is constructed and sets the title
     * shown in the block header.
     *
     * @return void
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_pin_user');
    }

    /**
     * Enables global configuration of the block in settings.php.
     *
     * @return bool True if the global configuration is enabled.
     */
    public function has_config() {
        return true;
    }
    /**
     * Generates the content of the block to be displayed on the participants page.
     *
     * The content is only shown if the user has the 'moodle/course:manageactivities' capability
     * and if the current page is the course participants page.
     * It displays a list of participants with custom badges based on two user profile fields.
     *
     * @return stdClass|null Object containing the HTML content to display, or null if not applicable.
     */
    public function get_content() {
        global $DB, $COURSE, $USER;

        // Ensure content is only generated once.
        if ($this->content !== null) {
            return $this->content;
        }

        // Check if the user has the capability to manage activities in the course (which teachers typically have).
        if (!has_capability('moodle/course:manageactivities', context_course::instance($COURSE->id))) {
            // If the user does not have the required capability, do not show the block.
            $this->content = null;
            return $this->content;
        }

        // Check if the current page is the Participants page.
        if ($this->page->pagetype !== 'course-participants'
        && !$this->page->url->compare(new moodle_url('/user/index.php'), URL_MATCH_BASE)) {
            // If it's not the participants page, don't render any content.
            $this->content = null;
            return $this->content;
        }

        // Load the CSS file for styling the badge.
        $this->page->requires->css(new moodle_url('/blocks/pin_user/css.php'));

        // Initialize content as an empty object.
        $this->content = new stdClass();

        // Get the block renderer.
        $renderer = $this->page->get_renderer('block_pin_user');

        // Retrieve user profile fields from the administrator settings.
        $profilefield1 = get_config('block_pin_user', 'profilefield1');
        $profilefield2 = get_config('block_pin_user', 'profilefield2');

        // Create the SQL query using the parameter values.
        $sql = "SELECT DISTINCT
                    u.id, u.firstname, u.lastname, u.email, u.firstnamephonetic, u.lastnamephonetic, u.middlename,
                    u.alternatename,
                    udf1.data AS udf_profilefield1_value,
                    udf2.data AS udf_profilefield2_value
                FROM {user} u
                LEFT JOIN {user_info_data} udf1
                    ON u.id = udf1.userid
                    AND udf1.fieldid = (SELECT id FROM {user_info_field} WHERE shortname = :profilefield1)
                LEFT JOIN {user_info_data} udf2
                    ON u.id = udf2.userid
                    AND udf2.fieldid = (SELECT id FROM {user_info_field} WHERE shortname = :profilefield2)
                JOIN {user_enrolments} ue
                    ON u.id = ue.userid
                JOIN {enrol} e
                    ON ue.enrolid = e.id
                WHERE
                    u.deleted = 0 AND e.courseid = :courseid";

        // Retrieve the courseid from the URL parameters.
        $courseid = required_param('id', PARAM_INT);

        // Parameters for the SQL query.
        $params = [
            'profilefield1' => $profilefield1, // Dynamically provided field name for profilefield1.
            'profilefield2' => $profilefield2, // Dynamically provided field name for profilefield2.
            'courseid' => $courseid,           // Course ID from the URL parameters.
        ];

        // Execute the SQL query.
        $participants = $DB->get_records_sql($sql, $params);

        // Initialize an empty string for the content.
        $content = '';

        // Loop through each participant and render their name with the EBS badge.
        foreach ($participants as $participant) {
            $content .= $renderer->render_participant_with_pin($participant);
        }

        // Assign the generated content.
        $this->content->text = $content;
        return $this->content;

    }
}
