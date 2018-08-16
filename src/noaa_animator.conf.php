<?php
/**
 * File: noaa_animator.conf.php
 * Author: Adam Thompson <adam@serialphotog.com>
 * Created: August 15, 2018
 * 
 * Purpose: Contains the configuration options for the NOAA Animator application. 
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation the 
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to 
 * permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the 
 * Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE 
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR 
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR 
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

 // Disallow direct access
 // DO NOT REMOVE THIS
 defined('NOAA_ANIMATOR') or die('404 Not Found Error');

/**
 * Here you will find the various configuration options for the NOAA Animator utility.
 */

 // The state to download maps for
 define('NOAA_ANIMATE_STATE', 'kentucky');

 // The output path where the animations will be saved to
 //define('NOAA_ANIMATE_OUTPUT_PATH', '/var/www/html/noaa-animate');
 define('NOAA_ANIMATE_OUTPUT_PATH', '/home/adam/test/');

 // The delay between each frame in the animation
 // This is measured in 'ticks'. GIFs have 100 ticks/second. 
 define('NOAA_ANIMATE_FRAME_DELAY', 100);

 // Create animation for the convective outlook
 define('NOAA_ANIMATE_ENABLE_CONVECTIVE_OUTLOOK', true);
 // The number of frames in a complete convective outlook animation
 define('NOAA_ANIMATE_CONVECTIVE_OUTLOOK_FRAMES', 16);

 // Create animation for hail probability
 define('NOAA_ANIMATE_ENABLE_HAIL_PROBABILITY', true);
 // The number of frames in a complete hail probability animation
 define('NOAA_ANIMATE_HAIL_PROBABILITY_FRAMES', 3);

 // Create ice accumulation animation
 define('NOAA_ANIMATE_ENABLE_ICE_ACCUMULATION', true);
 // The number of frames in a complete ice accumulation animation
 define('NOAA_ANIMATE_ICE_ACCUMULATION_FRAMES', 12);

// Create relative humidity animation
define('NOAA_ANIMATE_ENABLE_RELATIVE_HUMIDITY', true); 
// The number of frames in a complete relative humidity animation
define('NOAA_ANIMATE_RELATIVE_HUMIDITY_FRAMES', 55);

// Create max temperature animation
define('NOAA_ANIMATE_ENABLE_MAX_TEMP', true);
// The number of frames in a complete max temp animation
define('NOAA_ANIMATE_MAX_TEMP_FRAMES', 7);

// Create min temperature animation
define('NOAA_ANIMATE_ENABLE_MIN_TEMP', true);
// The number of frames in a complete min temp animation
define('NOAA_ANIMATE_MIN_TEMP_FRAMES', 7);

// Create animation of 12-hour precipitation probability
define('NOAA_ANIMATE_ENABLE_PROB_PRECIP', true);
// The number of frames in a complete 12-hour precipitation probability animation
define('NOAA_ANIMATE_PROB_PRECIP_FRAMES', 14);

// Create dry lightning animation
define('NOAA_ANIMATE_ENABLE_DRY_LIGHTNING', true);
// The number of frames in a complete dry lightning animation
define('NOAA_ANIMATE_DRY_LIGHTNING_FRAMES', 14);

// Create fire probability animation
define('NOAA_ANIMATE_ENABLE_FIRE_PROB', true);
// The number of frames in a complete fire probability animation
define('NOAA_ANIMATE_FIRE_PROB_FRAMES', 14);

// Create 6-hour precipitation animation
define('NOAA_ANIMATE_PRECIP_AMT', true);
// The nubmer of frames in a 6-hour precipitation animation
define('NOAA_ANIMATE_PRECIP_AMT_FRAMES', 12);

// Create sky cover animation
define('NOAA_ANIMATE_SKYCOVER', true);
// The number of frames in a skycover animation
define('NOAA_ANIMATE_SKYCOVER_FRAMES', 55);

// Create 6-hour snow amount animation
define('NOAA_ANIMATE_SNOW', true);
// The number of frames in a 6-hour snow amount animation
define('NOAA_ANIMATE_SNOW_FRAMES', 12);

// Create temperature animation
define('NOAA_ANIMATE_TEMP', true);
// The number of frames in a temperature animation
define('NOAA_ANIMATE_TEMP_FRAMES', 55);

// Create dewpoint temperature animation
define('NOAA_ANIMATE_DEWPOINT_TEMP', true);
// The number of frames in a dewpoint temperature animation
define('NOAA_ANIMATE_DEWPOINT_TEMP_FRAMES', 55);

// Create 24-hour tornado probability animation
define('NOAA_ANIMATE_TORNADO', true);
// The number of frames in a 24-hour tornado probability animation
define('NOAA_ANIMATE_TORNADO_FRAMES', 3);

// Create wind gust animation
define('NOAA_ANIMATE_WINDGUST', true);
// The number of frames in a windgust animation
define('NOAA_ANIMATE_WINDGUST_FRAMES', 24);

// Create wind speed animation
define('NOAA_ANIMATE_WINDSPEED', true);
// The number of frames in a windspeed animation
define('NOAA_ANIMATE_WINDSPEED_FRAMES', 55);

/**
 * The following configuration determines the NOAA code for each map type. You likely will not need to edit these.
 * Only make changes to this if you know what you're doing!
 */

define('MAP_TYPE_CONVECTIVE_OUTLOOK', 'ConvOutlook');
define('MAP_TYPE_HAIL_PROBABILITY', 'HailProb');
define('MAP_TYPE_ICE_ACCUMULATION', 'IceAccum');
define('MAP_TYPE_RELATIVE_HUMIDITY', 'RH');
define('MAP_TYPE_MAX_TEMP', 'MaxT');
define('MAP_TYPE_MIN_TEMP', 'MinT');
define('MAP_TYPE_PROB_PRECIP', 'PoP12');
define('MAP_TYPE_DRY_LIGHTNING', 'ProbDryLightning24');
define('MAP_TYPE_FIRE_PROB', 'ProbFireWx24');
define('MAP_TYPE_PRECIP_AMT', 'QPF');
define('MAP_TYPE_SKYCOVER', 'Sky');
define('MAP_TYPE_SNOW', 'SnowAmt');
define('MAP_TYPE_TEMP', 'T');
define('MAP_TYPE_DEWPOINT_TEMP', 'Td');
define('MAP_TYPE_TORNADO', 'TornadoProb');
define('MAP_TYPE_WINDGUST', 'WindGust');
define('MAP_TYPE_WINDSPEED', 'WindSpd');

?>