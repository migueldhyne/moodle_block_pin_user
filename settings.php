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
 * Settings configuration for the block_pin_user plugin.
 *
 * This file defines the settings and configuration options for the plugin.
 *
 * @package   block_pin_user
 * @copyright 2025, Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage(
        'block_pin_user_settings',
        get_string('pluginname', 'block_pin_user')
    );
    if ($ADMIN->fulltree) {

        // Badge 1.
        $settings->add(new admin_setting_heading(
            'block_pin_user_badge1_heading',
            get_string('badge1settings', 'block_pin_user'),
            get_string('badge1settings_desc', 'block_pin_user')
        ));

        $settings->add(new admin_setting_configtext(
        'block_pin_user/profilefield1',
        get_string('profilefield1', 'block_pin_user'),
        get_string('profilefield1_desc', 'block_pin_user'),
        'EBS'
        ));

        // Condition for Profilefield1.
        $settings->add(new admin_setting_configselect(
            'block_pin_user/profilefield1condition',
            get_string('profilefield1condition', 'block_pin_user'),
            get_string('profilefield1condition_desc', 'block_pin_user'),
            'isempty',
            [
                'isempty' => get_string('isempty', 'block_pin_user'),
                'isnotempty' => get_string('isnotempty', 'block_pin_user'),
                'equals' => get_string('equals', 'block_pin_user'),
                'contains' => get_string('contains', 'block_pin_user'),
                'notcontains' => get_string('notcontains', 'block_pin_user'),
            ]
        ));

        // Value for Profilefield1 condition.
        $settings->add(new admin_setting_configtext(
            'block_pin_user/profilefield1value',
            get_string('profilefield1value', 'block_pin_user'),
            get_string('profilefield1value_desc', 'block_pin_user'),
            ''
        ));

        $settings->add(new admin_setting_configcolourpicker(
            'block_pin_user/custombadge1bg',
            get_string('custombadge1bg', 'block_pin_user'),
            get_string('custombadge1bg_desc', 'block_pin_user'),
            '#229900'
        ));

        $settings->add(new admin_setting_configcolourpicker(
            'block_pin_user/custombadge1color',
            get_string('custombadge1color', 'block_pin_user'),
            get_string('custombadge1color_desc', 'block_pin_user'),
            'white'
        ));

        $settings->add(new admin_setting_configtext(
        'block_pin_user/text1',
        get_string('text1', 'block_pin_user'),
        get_string('text1_desc', 'block_pin_user'),
        'text1'
        ));

        // Badge 2 settings.
        $settings->add(new admin_setting_heading(
            'block_pin_user_badge2_heading',
            get_string('badge2settings', 'block_pin_user'),
            get_string('badge2settings_desc', 'block_pin_user')
        ));

        $settings->add(new admin_setting_configtext(
        'block_pin_user/profilefield2',
        get_string('profilefield2', 'block_pin_user'),
        get_string('profilefield2_desc', 'block_pin_user'),
        'sante'
        ));

        // Condition for Profilefield2.
        $settings->add(new admin_setting_configselect(
            'block_pin_user/profilefield2condition',
            get_string('profilefield2condition', 'block_pin_user'),
            get_string('profilefield2condition_desc', 'block_pin_user'),
            'isempty',
            [
                'isempty' => get_string('isempty', 'block_pin_user'),
                'isnotempty' => get_string('isnotempty', 'block_pin_user'),
                'equals' => get_string('equals', 'block_pin_user'),
                'contains' => get_string('contains', 'block_pin_user'),
                'notcontains' => get_string('notcontains', 'block_pin_user'),
            ]
        ));

        // Value for Profilefield2 condition.
        $settings->add(new admin_setting_configtext(
            'block_pin_user/profilefield2value',
            get_string('profilefield2value', 'block_pin_user'),
            get_string('profilefield2value_desc', 'block_pin_user'),
            ''
        ));


        $settings->add(new admin_setting_configcolourpicker(
            'block_pin_user/custombadge2bg',
            get_string('custombadge2bg', 'block_pin_user'),
            get_string('custombadge2bg_desc', 'block_pin_user'),
            '#5cb3ff'
        ));

        $settings->add(new admin_setting_configcolourpicker(
            'block_pin_user/custombadge2color',
            get_string('custombadge2color', 'block_pin_user'),
            get_string('custombadge2color_desc', 'block_pin_user'),
            'white'
        ));

        $settings->add(new admin_setting_configtext(
        'block_pin_user/text2',
        get_string('text2', 'block_pin_user'),
        get_string('text2_desc', 'block_pin_user'),
        'text2'
        ));

    }
}
