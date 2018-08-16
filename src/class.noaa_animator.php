<?php
/**
 * File: class.noaa_animator.php 
 * Author: Adam Thompson <adam@serialphotog.com>
 * Created: August 15, 2018
 * 
 * Purpose: Implements a simple api to render a GIF image from a series of still frames. 
 * 
 * Copyright 2018 Adam Thompson
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
 defined('NOAA_ANIMATOR') or die('404 Not Found Error');

 require_once('noaa_animator.conf.php');

class NOAAAnimator
{
    // The frames for the animation
    private $frames;

    // The animation frame delay
    private $delay = 500;

    // The resulting GIF
    private $gif = null;

    /**
     * Initializes the NOAA map animator
     * 
     * @param $frames (array) - Array of frames for the animation
     * @param $delay (int) - The delay between each frame in the animation
     */
    public function __construct($frames, $delay) {
        if (!is_array($frames)) {
            print("[ERROR]: Invalid animation frames received.");
            die(1);
        }
        $this->frames = $frames;
        $this->delay = $delay;
    }

    /**
     * Creates the animation
     */
    public function animate() {
        // Initialize the GIF
        $this->gif = new Imagick();
        $this->gif->setFormat("gif");

        // Add the frames to the animation
        foreach ($this->frames as $frame) {
            $animFrame = new Imagick();
            $animFrame->readImage($frame);
            $animFrame->setImageDelay($this->delay);
            $this->gif->addImage($animFrame);
        }
    }

    /**
     * Gets the GIF image blob
     * @return The image blob
     */
    public function getGifBlob() {
        return $this->gif->getImagesBlob();
    }

    /**
     * Writes the resulting GIF to disk
     * 
     * @param $outputPath (string) Path for the output file
     */
    public function writeGif($outputPath) {
        file_put_contents($outputPath, $this->getGifBlob());
    }
}   

?>