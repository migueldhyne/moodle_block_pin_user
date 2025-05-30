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
 * Library file for the block_pin_user plugin.
 *
 * This file defines the renderer for the Pin User block in Moodle,
 * which generates a link to each user’s profile and appends custom
 * badges based on conditions applied to their profile fields.
 *
 * @package   block_pin_user
 * @copyright 2025, Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Renderer class for the block_pin_user plugin.
 *
 * This class is responsible for rendering the output of the block, including
 * participant names and conditional badges based on user profile fields.
 */
class block_pin_user_renderer extends plugin_renderer_base {
    /**
     * Renders a participant's name along with custom badges based on profile field conditions.
     *
     * This function generates an HTML block displaying the participant's name
     * (as a link to their profile) and one or two badges, depending on whether
     * specific profile field values match configured conditions.
     *
     * @param stdClass $user The user record, including custom profile field values.
     * @return string HTML output for the participant line with optional badges.
     */
    public function render_participant_with_pin($user) {

        // Create the profile URL for the user.
        $courseid = required_param('id', PARAM_INT);
        $profileurl = new moodle_url('/user/view.php', ['id' => $user->id, 'course' => $courseid]);

        // Get the user's full name and create a link to their profile.
        $fullname = html_writer::link($profileurl, fullname($user));

        // Start HTML block.
        $html = html_writer::start_tag('div', ['class' => 'block_pin_user participant-name']);

        $html .= ' ' . $fullname;

        // Get plugin configuration.
        $text1 = get_config('block_pin_user', 'text1');
        $text2 = get_config('block_pin_user', 'text2');
        $profilefield1value = get_config('block_pin_user', 'profilefield1value');
        $profilefield1condition = get_config('block_pin_user', 'profilefield1condition');
        $profilefield2value = get_config('block_pin_user', 'profilefield2value');
        $profilefield2condition = get_config('block_pin_user', 'profilefield2condition');

        // Check profilefield1 condition.
        if ($this->evaluate_condition($user, 'udf_profilefield1_value', $profilefield1condition, $profilefield1value)) {
            $html .= $this->render_badge($text1, 'custom-badge1');
        }

        // Check profilefield2 condition.
        if ($this->evaluate_condition($user, 'udf_profilefield2_value', $profilefield2condition, $profilefield2value)) {
            $html .= $this->render_badge($text2, 'custom-badge2');
        }

        $html .= html_writer::end_tag('div');
        return $html;
    }

    /**
     * Returns an HTML span element used as a badge.
     *
     * This method generates a <span> tag with the given text and CSS class,
     * typically used to display badges next to participant names.
     *
     * @param string $text  The label to display inside the badge.
     * @param string $class The CSS class to apply for styling the badge.
     * @return string HTML span element representing the badge.
     */
    private function render_badge($text, $class) {
        return html_writer::tag('span', $text, ['class' => $class]);
    }

    /**
     * Evaluates a condition against a user's custom profile field value.
     *
     * Supported conditions include:
     * - 'isempty': checks if the field is empty.
     * - 'isnotempty': checks if the field is not empty.
     * - 'equals': checks for exact match with the expected value.
     * - 'contains': checks if the field contains the expected substring.
     * - 'notcontains': checks if the field does not contain the expected substring.
     *
     * @param stdClass $user      The user object containing custom profile field values.
     * @param string   $fieldkey  The name of the user property to check (e.g., 'udf_profilefield1_value').
     * @param string   $condition The condition to evaluate ('isempty', 'equals', etc.).
     * @param string   $expected  The value to compare the field against.
     * @return bool True if the condition is met, false otherwise.
     */
    private function evaluate_condition($user, $fieldkey, $condition, $expected) {

        if (!isset($user->{$fieldkey})) {
            return false;
        }

        $fieldvalue = $user->{$fieldkey};

        switch ($condition) {
            case 'isempty':
                return empty($fieldvalue);
            case 'isnotempty':
                return !empty($fieldvalue);
            case 'equals':
                return $fieldvalue === $expected;
            case 'contains':
                return strpos($fieldvalue, $expected) !== false;
            case 'notcontains':
                return strpos($fieldvalue, $expected) === false;
            default:
                return false;
        }
    }
}
