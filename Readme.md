# NOAA Weather Map Animator

The National Oceanic and Atmospheric Administration (NOAA) publishes various graphical weather maps online. These maps can be found [here](https://graphical.weather.gov/images/). Each forecast has a number of individual frames representing a forecast for a different moment in time. By using these as frames in an animated GIF, we can create a simple, animated weather forecast image. This project allows for the automatic creation of said GIFs. 

# Configuration

All of the configuration options are located in the **noaa_animator.conf.php** file. This file contains a number of defines that affect how the maps are generated. Here are the configuration options:

## NOAA_ANIMATE_STATE

This configures the state to generate maps for. Each state should be spelled out in lowercase. For example, to get the maps for Kentucky, I'd set this value to *kentucky*. 

## NOAA_ANIMATE_OUTPUT_PATH

This is the output path for all of the rendered gifs.

**NOTE:** Each rendered gif will be placed within its own subdirectory within this path. The name of this subdirectory is the same as the code-name used by NOAA. A list of these codes can be found below.

## The Various Map Types

Each map type has two configuration options associated with it. 

The first is a true/false boolean value that determines rather or not we want to generate that type of map. Setting this value to *true* will cause the application to generate an animated gif for that map, *false* means it will not be generated. 

The second configuration option contains the total number of frames for the complete animation. This is determined by how many frames are available on the NOAA server. You can likely just leave these as default.

## Map Type Codes

At the very bottom of the configuration file are a series of defines for the various map types. These should likely be left as default. **You should only edit these values if you know what you're doing**. 

# Map Codes

As mentioned above, each rendered map is stored in a subdirectory with the same name as the NOAA map code. Here is a list of the codes:

* **ConvOutlook:** Convective outlook forecast
* **HailProb:** Hail probability forecast
* **IceAccum:** Ice accumulation forecast
* **RH:** The relative humidity forecast
* **MaxT:** The max temperature forecast
* **MinT:** The min temperature forecast
* **PoP12:** The 12-hour precipitation probability forecast
* **ProbDryLightning24:** Forecasts the probability of dry lightning over the next 24-hours.
* **ProbFireWx24:** 24-hour fire probability outlook.
* **QPF:** The 6-hour precipitation forecast
* **Sky:** The total sky cover forecast
* **SnowAmt:** Snow accumulation forecast
* **T:** Temperature forecase
* **Td:** Dewpoint temperature forecast
* **TornadoProb:** The forecase for the probability of a tornado
* **WindGust:** The windgust forecast
* **WindSpd:** The windspeed forecast