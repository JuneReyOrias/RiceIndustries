
@extends('agent.agent_Dashboard')

@section('agent')
<script src="https://js.arcgis.com/4.23/"></script>
    <style>
        
        #map {
            justify-content: center;
            align-items: center;
            width: 70%;
            height: 800px; /* Adjust the map height as needed */
            margin-top: 20px;
            margin-left:230px; /* Adjust the map height as needed */
        }
        
        .esri-ui-top-left {
            position: absolute;
            top: 100px;
            left: 20px;
        
        }
        
        .esri-ui-top-right {
            position: absolute;
            top: 100px;
            right: 100px;
            z-index: 20;
        }
        
        .esri-ui-bottom-left {
            position: absolute;
            bottom: 10px;
            left: 10px;
            z-index: 10;
        }
        
        .esri-ui-bottom-right {
            position: absolute;
            bottom: 10px;
            right: 10px;
            z-index: 20;
        }
    </style>
    <div id="map"></div>
    <script>
        require([
            "esri/Map",
            "esri/views/MapView",
            "esri/widgets/BasemapGallery",
            "esri/widgets/Search",
            "esri/Graphic", 
            "esri/symbols/SimpleMarkerSymbol",
            "esri/geometry/Polygon",
        ], function (Map, MapView, BasemapGallery, Search,Graphic,SimpleMarkerSymbol,Polygon) {
            // Create the map
            const map = new Map({
                basemap: "hybrid"
            });

            // Create the map view
            var view = new MapView({
                container: "map",
                map: map,
                center: [122.0790, 6.9214], // Replace with actual coordinates
                zoom: 12, // Adjust the initial zoom level as needed
                ui: {
                    components: [] // Disable the default UI components
                }
            });
@endsection
