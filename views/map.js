function updateMap() {
    const layer = document.getElementById('layerSelect').value;
    const lat = 23.64; // Default latitude
    const lon = 91.34; // Default longitude
    const zoom = 6; // Default zoom level
    const url = `https://www.ventusky.com/?p=${lat};${lon};${zoom}&l=${layer}`;
    document.getElementById('mapIframe').src = url;
}