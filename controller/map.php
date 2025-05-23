<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Map</title>
    <link rel="stylesheet" href="../views/map.css">
</head>
<body>
    <div id="sidebar"></div>

    <div class="container">
        <h1>Weather Map</h1>
        <div class="controls">
            <label for="layerSelect">Select Weather Layer:</label>
            <select id="layerSelect" onchange="updateMap()">
                <option value="temperature-2m" selected>Temperature</option>
                <option value="precipitation">Precipitation</option>
                <option value="wind">Wind</option>
                <option value="clouds">Clouds</option>
            </select>
        </div>
        <iframe id="mapIframe" src="https://www.ventusky.com/?p=23.64;91.34;6&l=temperature-2m" frameborder="0"></iframe>
    </div>
    <script src="../views/map.js"></script>
</body>
</html>
