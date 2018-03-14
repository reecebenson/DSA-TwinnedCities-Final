/**
 * Variables
 */
let $ = jQuery;
let base = $(document);
let currentCity = null;

/**
 * Function to fetch weather forecast
 */
function fetchWeatherForecast(woeId, lat, long) {
    let fcWindow = window.open("./pages/weatherforecast.php?woeid=" + woeId, "Forecast for " + currentCity.name, "location=1,status=1,scrollbars=0,resizable=no,width=800,height=400,menubar=no,toolbar=no");
}

/**
 * Function to fetch weather via AJAX Call
 */
function fetchWeather(woeId, lat, long) {
    /**
     * Elements
     */
    // Map
    let mapDiv = $("#map");
    // Weather
    let weatherContent = $("#ajaxWeather");
    let weatherName = weatherContent.find("#name");
    let weatherInfo = weatherContent.find("#data");
    let weatherIcon = weatherContent.find("#ajaxWeatherIcon");
    let weatherTime = weatherContent.parent().find(".last-pull");
    // Information
    let informationContent = $("#ajaxInformation");
    // Points of Interest
    let poiContent = $("#ajaxPointsOfInterest");

    let tempDiff = 273.15;
    $.ajax({
        method: 'POST',
        dataType: 'json',
        url: './data/fetchWeather.php',
        async: false,
        timeout: 30000,
        data: { woeid: woeId, latitude: lat, longitude: long },
        error: () => {
            weatherName.html("There was an issue trying to fetch the data.");
            weatherTime.html("<a href='javascript:fetchWeatherForecast(" + woeId + ", " + lat + ", " + long + ");'>Forecast</a> | <a href='javascript:fetchWeather(" + woeId + ", " + lat + ", " + long + ");'>Refresh</a>");
            weatherInfo.html("");
            weatherContent.html("");
        },
        success: (result) => {
            // Deconstruct Variables
            let weatherData = result.weather;
            let tempCurrent = Math.floor(weatherData.main.temp - tempDiff);
            let tempMin = Math.floor(weatherData.main.temp_min - tempDiff);
            let tempMax = Math.floor(weatherData.main.temp_max - tempDiff);

            // Information
            let tempString = "Currently " + tempCurrent + "&#8451;, from " + tempMin + "&#8451; to " + tempMax + "&#8451;";
            let windString = "Wind: " + weatherData.wind.speed + "m/s, " + weatherData.wind.deg + "&deg; (" + getCardinalDirection(weatherData.wind.deg) + ")";
            let sunRiseSet = "Sunrise: " + weatherData.sunrise + ", Sunset: " + weatherData.sunset;

            // Set Weather Icon
            weatherName.html("<strong>" + toTitleCase(weatherData.weather[0].description) + "</strong> <small>(" + weatherData.clouds.all + "% clouds)</small>");
            weatherInfo.html(tempString + "<br/>" + windString + "<br/>" + sunRiseSet);
            weatherTime.html("Last updated " + result.timeago + " | <a href='javascript:fetchWeatherForecast(" + woeId + ", " + lat + ", " + long + ");'>Forecast</a> | <a href='javascript:fetchWeather(" + woeId +", " + lat + ", " + long + ");'>Refresh</a>");
            weatherIcon.attr("src", "http://openweathermap.org/img/w/" + weatherData.weather[0].icon + ".png");

            // Debug
            console.log(result);
        }
    });
}

/**
    * Function to fetch Information via AJAX Call
    */
function fetchInformation(woeId) {
    /**
        * Elements
        */
    let ajaxInfo = $("#ajaxInformation");

    // Submit Ajax Request
    $.ajax({
        method: 'POST',
        dataType: 'json',
        url: './data/fetchInfo.php',
        async: false,
        timeout: 30000,
        data: { woeid: woeId },
        error: () => {
            ajaxInfo.html("There was an issue trying to fetch the data.");
        },
        success: (result) => {
            let cityInfo = result.city;
            let info = "";

            // Build City Information
            info += "<div class='row'>";
            info += "<div class='col-5' style='font-weight:bold; text-align: right;'>Name:<br/>Population:<br/>Timezone:<br/>Lat/Long:<br/>Current Time:</div>";
            info += "<div class='col'>" + cityInfo.name + "<br/>" + cityInfo.population + "<br/>" + cityInfo.timezone + "<br/>" + cityInfo.lat + "," + cityInfo.long + "<br/><div id='currentTimezone'>Calculating...</div></div>";
            info += "</div>";

            // Present Information
            ajaxInfo.html(info);

            // Calculate Time
            updateTimezones(cityInfo.timezone, cityInfo.timezone);

            // Debug
            console.log(result);
        }
    });
}

/**
    * Function to fetch POIs via AJAX Call
    */
function fetchPointsOfInterest(woeId) {
    /**
        * Elements
        */
    let ajaxPoi = $("#ajaxPointsOfInterest");

    // Submit Ajax Request
    $.ajax({
        method: 'POST',
        dataType: 'json',
        url: './data/fetchPointsOfInterest.php',
        async: false,
        timeout: 30000,
        data: { woeid: woeId, type: "list" },
        error: () => {
            ajaxPoi.html("There was an issue trying to fetch the data.");
        },
        success: (result) => {
            // Present Information
            ajaxPoi.html(result.text);

            // Debug
            console.log(result);
        }
    });
}

/**
    * Convert each first letter of each word to Upper Case
    */
function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });
}

/**
    * Convert Degrees into Cardinal Direction
    */
function getCardinalDirection(angle) {
    if (typeof angle === 'string') angle = parseInt(angle);
    if (angle <= 0 || angle > 360 || typeof angle === 'undefined') return '☈';
    const arrows = { north: '↑ N', north_east: '↗ NE', east: '→ E', south_east: '↘ SE', south: '↓ S', south_west: '↙ SW', west: '← W', north_west: '↖ NW' };
    const directions = Object.keys(arrows);
    const degree = 360 / directions.length;
    angle = angle + degree / 2;
    for (let i = 0; i < directions.length; i++) {
        if (angle >= (i * degree) && angle < (i + 1) * degree) return arrows[directions[i]];
    }
    return arrows['north']; // < Fallback
}

/****************************
    * MAP
    ****************************/
var map;
var mapStyle = [
    {
        "featureType": "administrative",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.land_parcel",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    }
];

/**
    * Variables
    */
var infoWindow, markerClicked, markers = [];

/**
    * Truncation Function
    */
String.prototype.trunc = String.prototype.trunc ||
    function(n) {
        return (this.length > n) ? this.substr(0, n-1) + '&hellip;' : this;
    };

function buildMarkerContent(content) {
    let name = content.name;
    let desc = content.desc.trunc(200);
    let website = content.www;
    let phone = content.phone;

    let cWebsite = "<button onclick='window.open(\"" + website + "\", \"_blank\");' class='btn btn-default'><i class='fa fa-globe'></i></button>";
    let cPhone = "<button class='btn btn-default' " + (phone == null ? "disabled" : "") + " onclick='window.open(\"" + (phone != null ? "tel:" + phone : "") + "\");'><i class='fa fa-phone'></i></button>";

    return "<div style='width: 400px;'><h3>" + name + "</h3><p>" + desc + "&nbsp;</p><div class='btn-group' role='group'>" + cWebsite + cPhone + "</div></div>";
}

function createMarker(name, content, m) {
    let latlong = new google.maps.LatLng(content.lat, content.long);
    let marker = new google.maps.Marker({
        map: m,
        position: latlong,
        data: content
    });
    markers.push(marker);

    google.maps.event.addListener(marker, 'mouseover', function() {
        infoWindow.setContent(buildMarkerContent(content));
        infoWindow.open(m, this);
    });
}

function initialiseMap(_lat, _long, woeId) {
    let latlong = { lat: _lat, lng: _long };

    // Create our Map
    map = new google.maps.Map(document.getElementById("map"), {
        mapTypeControlOptions: {
            mapTypeIds: ['mapstyle']
        },
        center: latlong,
        zoom: 12,
        mapTypeId: 'mapStyle'
    });
    map.mapTypes.set('mapStyle', new google.maps.StyledMapType(mapStyle, { name: "Default Style" }));
    infoWindow = new google.maps.InfoWindow();

    // Generate Markers
    markers = [];
    $.each(currentCity.poi, (key, val) => createMarker(key, val, map));
}

function selectPoint(markerId) {
    infoWindow.setContent(buildMarkerContent(markers[markerId].data));
    infoWindow.open(map, markers[markerId]);
    console.log(markers[markerId]);
}

function executeCity(woeId, lat, long, page) {
    // Get our content holder
    let contentHolder = $("#ajaxContent");

    // Get our specified page
    waitForLoad();
    switch(page) {
        default: case "home": {
            $.get("./pages/main.php", function(data) {
                // Replace HTML with the data inside of content
                contentHolder.html(data);

                // Initialise City Data
                initialiseMap(lat, long, woeId);
                fetchWeather(woeId, lat, long);
                fetchInformation(woeId);
                fetchPointsOfInterest(woeId);
            });
        };
        break;

        case "poi": {
            $.get("./pages/poi.php?woeid="+woeId, function(data) {
                // Replace HTML with the data inside of content
                contentHolder.html(data);
            });
        };
        break;

        case "specific_poi": {
            $.get("./pages/singlepoi.php?woeid="+woeId+"&id=null", function(data) {
                // Replace HTML with the data inside of content
                contentHolder.html(data);
            });
        };
        break;

        case "twitter": {
            $.get("./pages/twitter.php?woeid="+woeId, function(data) {
                // Replace HTML with the data inside of content
                contentHolder.html(data);
            });
        };
        break;

        case "flickr": {
            $.get("./pages/flickr.php?woeid=" + woeId, function(data) {
                // Replace HTML with the data inside of content
                contentHolder.html(data);
            });
        };
        break;
    }
}

/**
    * Navigation Bar Button Reset
    */
function removeActiveButtons() {
    let navbar = $("#navbarNav");
    navbar.each(function() {
        $(this).find("li").each(function() {
            let navbarItem = $(this);
            navbarItem.removeClass("active");
        });
    });
}

/**
    * Function to update timezone text
    */
function updateTimezones(tz, currentTz) {
    // Check if we're still running the same city
    if(tz != currentTz)
        return;

    // Declare Elements
    const timezoneArea = $("#currentTimezone");

    // Check if our element exists
    setTimeout(() => {
        // Check if our element exists
        if(timezoneArea != null) {
            // Get our formatted strings for the timezones on our cities
            const cityTimezone = moment().tz(tz).format('MMMM Do YYYY, h:mm:ss a');

            // Update HTML
            timezoneArea.html(cityTimezone);

            // Recursive Function
            updateTimezones(tz, currentCity.timezone);
        }
    }, 1000);
}

            
/**
 * Execute AJAX Calls when browser is ready
 */
base.ready(() => {
/**
 * Setup Clickers
 */
let currentPage = "home";
let btnCityOne = $("#cityOneClick");
let btnCityTwo = $("#cityTwoClick");
let btnHome = $("#btnHome");
let btnPoi = $("#btnPoi");
let btnTwitter = $("#btnTwitter");
let btnFlickr = $("#btnFlickr");

/**
 * Setup Listeners
 */
btnCityOne.click(function() {
    btnCityOne.parent().addClass("active");
    btnCityTwo.parent().removeClass("active");
    btnPoi.removeClass("disabled");
    btnTwitter.removeClass("disabled");
    btnFlickr.removeClass("disabled");
    currentCity = cityOne;
    console.log(currentCity);
    executeCity(cityOne.woeid, cityOne.lat, cityOne.long, currentPage);
});

btnCityTwo.click(function() {
    btnCityTwo.parent().addClass("active");
    btnCityOne.parent().removeClass("active");
    btnPoi.removeClass("disabled");
    btnTwitter.removeClass("disabled");
    btnFlickr.removeClass("disabled");
    currentCity = cityTwo;
    executeCity(cityTwo.woeid, cityTwo.lat, cityTwo.long, currentPage);
});

btnHome.click(function() {
    if(currentCity == null) return;
    executeCity(currentCity.woeid, currentCity.lat, currentCity.long, "home");
    currentPage = "home";
    removeActiveButtons();
    btnHome.parent().addClass("active");
});

btnPoi.click(function() {
    if(currentCity == null) return;
    executeCity(currentCity.woeid, currentCity.lat, currentCity.long, "poi");
    currentPage = "poi";
    removeActiveButtons();
    btnPoi.parent().addClass("active");
});

btnTwitter.click(function() {
    if(currentCity == null) return;
    executeCity(currentCity.woeid, currentCity.lat, currentCity.long, "twitter");
    currentPage = "twitter";
    removeActiveButtons();
    btnTwitter.parent().addClass("active");
});

btnFlickr.click(function() {
    if(currentCity == null) return;
    executeCity(currentCity.woeid, currentCity.lat, currentCity.long, "flickr");
    currentPage = "flickr";
    removeActiveButtons();
    btnFlickr.parent().addClass("active");
});

/**
 * Disable buttons whilst currentCity is null
*/
if(currentCity == null) {
    btnPoi.addClass("disabled");
    btnTwitter.addClass("disabled");
    btnFlickr.addClass("disabled");
}

/**
 * Ready!
 */
console.log("Ready!");
});