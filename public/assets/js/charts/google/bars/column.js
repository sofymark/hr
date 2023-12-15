/* ------------------------------------------------------------------------------
 *
 *  # Google Visualization - columns
 *
 *  Google Visualization column chart demonstration
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */


// Column chart
// ------------------------------

// Initialize chart
google.load("visualization", "1", {packages:["bar"]});
google.setOnLoadCallback(drawColumn);


// Chart settings
function drawColumn() {
    var data = new google.visualization.arrayToDataTable([
        ['Galaxy', 'Distance', 'Brightness'],
        ['Canis Major Dwarf', 8000, 23.3],
        ['Sagittarius Dwarf', 24000, 4.5],
        ['Ursa Major II Dwarf', 30000, 14.3],
        ['Lg. Magellanic Cloud', 50000, 0.9],
        ['Bootes I', 60000, 13.1]
    ]);

    var options = {
        width: 900,
        chart: {
            title: 'Nearby galaxies',
            subtitle: 'distance on the left, brightness on the right'
        },
        series: {
            0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
        },
        axes: {
            y: {
                distance: {label: 'parsecs'}, // Left y-axis.
                brightness: {side: 'right', label: 'apparent magnitude'} // Right y-axis.
            }
        }
    };

    // Draw chart
    var column = new google.charts.Bar($('#google-column')[0]);
    column.draw(data, options);
}


// Resize chart
// ------------------------------

$(function () {

    // Resize chart on sidebar width change and window resize
    $(window).on('resize', resize);

    // Resize function
    function resize() {
        drawColumn();
    }
});
