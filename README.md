# Pin User Block

**Version:** v1.0  
**Moodle Required:** 3.11 or higher  
**Author:** Miguël Dhyne <miguel.dhyne@gmail.com>  
**License:** GNU GPL v3+

## Table of Contents

- [Overview](#overview)  
- [Features](#features)  
- [Requirements](#requirements)  
- [Installation](#installation)  
- [Configuration](#configuration)  
- [Usage](#usage)  
- [Screenshots](#screenshots) (Optional)  
- [Changelog](#changelog)  
- [License](#license)

## Overview

The **Pin User Block** plugin displays customizable badges next to user names on a Moodle course participants page. These badges are based on profile fields defined in the site administration and can be conditionally shown according to configurable rules.

## Features

- **Two configurable badges** (Badge 1 and Badge 2)  
- **Customizable deployment conditions:**  
  - Field is empty / not empty  
  - Equals / contains / does not contain a given value  
- **Custom text and background colors** for each badge  
- **Dynamic CSS loading** based on configuration  
- **Access restricted** to users with the `moodle/course:manageactivities` capability (typically teachers)

## Requirements

- Moodle 3.11 or higher  
- PHP 7.x or higher  
- Administrator privileges to install and configure the block

## Installation

1. Copy the `pin_user` folder into the `blocks/` directory of your Moodle installation.  
2. Log in to Moodle as an administrator and trigger plugin upgrade: **Site administration > Notifications**.  
3. Verify that `block_pin_user` appears in the list of installed blocks.

## Configuration

1. Go to **Site administration > Plugins > Blocks > Pin User**.  
2. Define settings for each badge:  
   - **Profile field:** shortname of the profile field to check  
   - **Condition:** empty, not empty, equals, contains, does not contain  
   - **Value:** string to compare (if applicable)  
   - **Badge text:** label displayed inside the badge  
   - **Badge colors:** background and text color values (hex codes)  
3. Repeat for Badge 2 if desired.

## Usage

1. In a course, turn on editing mode and add the **Pin User** block: **Turn editing on > Add a block > Pin User**.  
2. Navigate to the **Participants** page of the course: **Course > Participants**.  
3. User names will display one or two badges next to them depending on the configured conditions.

## Changelog

- **v1.0 (2025-05-02):** Initial release.

## License

This plugin is released under the GNU GPL3. See the `LICENSE` file for full details.
