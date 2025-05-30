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
 * This file contains functions and callbacks specific to the block_pin_user plugin.
 *
 * @package   block_pin_user
 * @copyright 2024, Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Adds settings for the block_pin_user plugin to the admin settings tree.
 *
 * This function is automatically called by Moodle when building the admin settings tree.
 * It allows the plugin to define configurable settings in settings.php.
 *
 * @param admin_settingpage $settings The settings page for this plugin.
 * @param admin_root $adminroot The full admin tree (unused but required by signature).
 * @return void
 */
function block_pin_user_plugin_settings($settings, $adminroot) {
}
