$( document ).ready(function() {
    var mymap = L.map('workorder-map').setView([39.112560, -77.179110], 15);

    var marker = L.marker([39.112560, -77.179110]).addTo(mymap);
    
    L.tileLayer('https://tile.jawg.io/jawg-light/{z}/{x}/{y}.png?access-token=t98cJvo5COpONHFHYvQtU51EtTGrzzYLVqE8P5azaYjZyNOs8Ntae6a7RRlknB6U', {}).addTo(mymap);
    mymap.attributionControl.addAttribution("<a href=\"https://www.jawg.io\" target=\"_blank\">&copy; Jawg</a> - <a href=\"https://www.openstreetmap.org\" target=\"_blank\">&copy; OpenStreetMap</a>&nbsp;contributors")
});