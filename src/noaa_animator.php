<?php
/**
 * File: noaa_animator.php 
 * Author: Adam Thompson <adam@serialphotog.com>
 * Created: August 15, 2018
 * 
 * Purpose: The main application handler. 
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

// Required for the class files to execute properly.
define('NOAA_ANIMATOR', true);

require_once('class.noaa_handler.php');
require_once('class.renderer.php');

class NOAAGifRenderer
{
    // The NOAA Handler instance
    private $noaaHandler;

    // The renderer instance
    private $renderer;

    /**
     * Determines what animations to create, based off the config file, and sets off the render tasks.
     */
    public function __construct() {
        $this->noaaHandler = new NOAAHandler(NOAA_ANIMATE_STATE, NOAA_ANIMATE_OUTPUT_PATH);
        $this->renderer = new Renderer();
    
        if (NOAA_ANIMATE_ENABLE_CONVECTIVE_OUTLOOK) {
            $nFrames = NOAA_ANIMATE_CONVECTIVE_OUTLOOK_FRAMES;
            $code = MAP_TYPE_CONVECTIVE_OUTLOOK;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_ENABLE_HAIL_PROBABILITY) {
            $nFrames = NOAA_ANIMATE_HAIL_PROBABILITY_FRAMES;
            $code = MAP_TYPE_HAIL_PROBABILITY;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_ENABLE_ICE_ACCUMULATION) {
            $nFrames = NOAA_ANIMATE_ICE_ACCUMULATION_FRAMES;
            $code = MAP_TYPE_ICE_ACCUMULATION;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_ENABLE_RELATIVE_HUMIDITY) {
            $nFrames = NOAA_ANIMATE_RELATIVE_HUMIDITY_FRAMES;
            $code = MAP_TYPE_RELATIVE_HUMIDITY;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_ENABLE_MAX_TEMP) {
            $nFrames = NOAA_ANIMATE_MAX_TEMP_FRAMES;
            $code = MAP_TYPE_MAX_TEMP;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_ENABLE_MIN_TEMP) {
            $nFrames = NOAA_ANIMATE_MIN_TEMP_FRAMES;
            $code = MAP_TYPE_MIN_TEMP;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_ENABLE_PROB_PRECIP) {
            $nFrames = NOAA_ANIMATE_PROB_PRECIP_FRAMES;
            $code = MAP_TYPE_PROB_PRECIP;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_ENABLE_DRY_LIGHTNING) {
            $nFrames = NOAA_ANIMATE_DRY_LIGHTNING_FRAMES;
            $code = MAP_TYPE_DRY_LIGHTNING;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_ENABLE_FIRE_PROB) {
            $nFrames = NOAA_ANIMATE_FIRE_PROB_FRAMES;
            $code = MAP_TYPE_FIRE_PROB;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_PRECIP_AMT) {
            $nFrames = NOAA_ANIMATE_PRECIP_AMT_FRAMES;
            $code = MAP_TYPE_PRECIP_AMT;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_SKYCOVER) {
            $nFrames = NOAA_ANIMATE_SKYCOVER_FRAMES;
            $code = MAP_TYPE_SKYCOVER;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_SNOW) {
            $nFrames = NOAA_ANIMATE_SNOW_FRAMES;
            $code = MAP_TYPE_SNOW;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_TEMP) {
            $nFrames = NOAA_ANIMATE_TEMP_FRAMES;
            $code = MAP_TYPE_TEMP;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_DEWPOINT_TEMP) {
            $nFrames = NOAA_ANIMATE_DEWPOINT_TEMP_FRAMES;
            $code = MAP_TYPE_DEWPOINT_TEMP;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_TORNADO) {
            $nFrames = NOAA_ANIMATE_TORNADO_FRAMES;
            $code = MAP_TYPE_TORNADO;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_WINDGUST) {
            $nFrames = NOAA_ANIMATE_WINDGUST_FRAMES;
            $code = MAP_TYPE_WINDGUST;
            $this->createJob($code, $nFrames);
        }
    
        if (NOAA_ANIMATE_WINDSPEED) {
            $nFrames = NOAA_ANIMATE_WINDSPEED_FRAMES;
            $code = MAP_TYPE_WINDSPEED;
            $this->createJob($code, $nFrames);
        }
    
        $this->renderer->render();
        $this->cleanup();
    }

    /**
     * Creates a new render job.
     * 
     * @param $code (string) - The map code
     * @param $nFrames (int) - The number of frames for the job
     */
    function createJob($code, $nFrames) {
        $frames = $this->noaaHandler->downloadMaps(1, $nFrames, $code);
        $this->renderer->addJob($frames, $this->buildOutputPath($code));
    }

    /**
     * Creates the output path for the final GIF file.
     * 
     * @param $code (string) - The map code
     * @return (string) - The output path
     */
    function buildOutputPath($code) {
        $dir = NOAA_ANIMATE_OUTPUT_PATH . $code . '/';

        // Create the output dir if it doesn't exist
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        return $dir . $code . '_' . NOAA_ANIMATE_STATE . '.gif';
    }

    /**
     * Cleans up the individual frames used to render the animations.
     */
    function cleanup() {
        $frameList = $this->renderer->getFrames();
        foreach ($frameList as $frames) {
            foreach ($frames as $frame) {
                if (file_exists($frame)) {
                    unlink($frame);
                }
            }
        }
    }

}

// Run the app
$app = new NOAAGifRenderer();


?>