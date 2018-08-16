<?php
/**
 * File: class.noaa_handler.php
 * Author: Adam Thompson <adam@serialphotog.com>
 * Created: August 14, 2018
 *
 * Purpose: The NOAAHandler class provides a simple api for accessing and downloading weather prediction images from
 * NOAA.
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
 
 // The base NOAA URL for the images
 define("NOAA_BASE_URL", "https://graphical.weather.gov/images/");
 
 
 class NOAAHandler
 {
    // The state to download images for
    private $state;

    // The output path for the downloaded maps
    private $outputPath;
 
    /**
     * Initializes the NOAA handler.
     *
     * @param $state (string) - The state we want images for.
     * @param $mapType (string) - The type of map we are interested in.
     * @param $outputPath (string) - The path to output downloaded maps to (defaults to "./")
     */
    public function __construct($state, $outputPath = "./") {
        $this->state = $state;
        $this->outputPath = $outputPath;

        // Validate the file path
        if (!file_exists($this->outputPath)) {
            print("[ERROR]: The output path " . $this->outputPath . " does not exist!\n");
            die(1);
        }
    }
 
    /**
     * Builds the url for the maps
     *
     * @param $mapNum (int) - The map number we need
     * @return (string) - The final URL
     */
    private function buildMapUrl($mapNum, $mapType) {
        return NOAA_BASE_URL . $this->state . "/" . $mapType . strval($mapNum) . "_" . $this->state . ".png";
    }

    /**
     * Creates the output URI for a downloaded map image.
     * 
     * @param $mapNum (int) - The map number to get a URI for
     * @param $path (string) - The path to write to on the filesystem (defaults to "./")
     * @return (string) - The built URI
     */
    private function buildOutputUri($mapNum, $mapType) {
        return $this->outputPath . $mapType . $mapNum . "_" . $this->state . ".png";
    }
 
    /**
     * Downloads a series of maps from the server.
     * 
     * @param $start (int) - The starting map number
     * @param $end (int) - The ending map number
     * @return (array) - Array of frames
     */
    public function downloadMaps($start, $end, $mapType) {
        $frames = array();

        for ($i=$start; $i <= $end; $i++) {
            // Build the filesystem URI
            $uri = $this->buildOutputUri($i, $mapType);

            // The NOAA server throws a 403 HTTP error if we don't have a user agent string
            $context = stream_context_create(array(
                'http' => array(
                    'header' => array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201'),
                ),
             ));
            
            if (copy($this->buildMapUrl($i, $mapType), $uri, $context))
            {
                $frames[$i] = $uri;
            }

        }

        return $frames;
    }
 
 }
 
 ?>