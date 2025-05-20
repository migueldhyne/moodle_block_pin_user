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
 * Dynamic CSS generator for the block_pin_user plugin.
 *
 * This file dynamically generates CSS styles based on plugin settings.
 *
 * @package   block_pin_user
 * @copyright 2025, Miguël Dhyne <miguel.dhyne@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_login();

header("Content-Type: text/css");

// Retrieve the configured settings.
$badge1bg = get_config('block_pin_user', 'custombadge1bg');
$badge1bg = $badge1bg ?: '#229900';
$badge1color = get_config('block_pin_user', 'custombadge1color');
$badge1color = $badge1color ?: 'white';
$badge2bg = get_config('block_pin_user', 'custombadge2bg');
$badge2bg = $badge2bg ?: '#5cb3ff';
$badge2color = get_config('block_pin_user', 'custombadge2color');
$badge2color = $badge2color ?: 'white';

// Generate CSS.
echo "
.custom-badge1 {
    background-color: {$badge1bg};
    color: {$badge1color};
    padding: 2px 5px;
    border-radius: 3px;
    margin-left: 5px;
    font-size: 0.8em;
}
.custom-badge2 {
    background-color: {$badge2bg};
    color: {$badge2color};
    padding: 2px 5px;
    border-radius: 3px;
    margin-left: 5px;
    font-size: 0.8em;
}
";
