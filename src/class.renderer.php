<?php
/**
 * File: class.renderer.php 
 * Author: Adam Thompson <adam@serialphotog.com>
 * Created: August 15, 2018
 * 
 * Purpose: Implements and manages a render job queue. 
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

require_once('class.noaa_animator.php');

class Renderer 
{
    // The render job queue.
    // This is a two dimensional array. Each element is an associative array of the following:
    //      'frames' => Array of frames for the animation job
    //      'output' => The output path for the final, rendered GIF 
    private $queue = array();

    /**
     * Adds a job to the render queue
     * 
     * @param $frames (array) - All the frames for the render job
     * @param $output (string) - The output path for the final render
     */
    public function addJob($frames, $output) {
        $job = array();
        $job['frames'] = $frames;
        $job['output'] = $output;
        $this->queue[count($this->queue)] = $job;
    }

    /**
     * Renders all the jobs in the queue
     */
    public function render() {
        foreach ($this->queue as $job) {
            $animator = new NOAAAnimator($job['frames'], NOAA_ANIMATE_FRAME_DELAY);
            $animator->animate();
            $animator->writeGif($job['output']);
        }
    }

    /**
     * Gets all the frames from all the render queue jobs
     * 
     * @return (array) - Array of arrays of frames. This is used for cleanup
     */
    public function getFrames() {
        $result = array();
        for ($i=0; $i < count($this->queue); $i++) {
            $result[$i] = $this->queue[$i]['frames'];
        }
        return $result;
    }
}

?>