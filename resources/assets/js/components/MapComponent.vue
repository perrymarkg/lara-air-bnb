<template>
    <div class="gmap-wrapper" >
        <input 
            type="text" 
            class="map-search form-control" 
            placeholder="Search for a Country or City"
            v-if="search" 
            v-bind:id="(mapName + '-search')" 
            />
        
        <div v-bind:id="mapName" v-bind:style="{height: height + 'px'}"></div>
        <input type="hidden" v-if="search" v-bind:name="'lat'" v-bind:id="(mapName + '-lat')" />
        <input type="hidden" v-if="search" v-bind:name="'lng'" v-bind:id="(mapName + '-lng')" />
    </div>
</template>

<script>
export default {
    props: {
        name: {},
        height: {
            default: 300,
            type: Number
        },
        center: {
            default: function(){ return {lat: 0, lng: 0} },
            type: Object
        },
        zoom: {
            default: 5,
            type: Number
        },
        search: {
            default: false,
            type: Boolean
        },
        markers: {
            default: function(){ return []},
            type: Array
        }
    },
    data: function() {
        return {
            mapName: this.name + '-gmap',
            map: null,
            searchBox: null,
            searchMarker: null,
            searchLat: null,
            searchLng: null
        }
    },
    mounted() {
        this.initMap();

        if( this.search ){
            this.initSearch();
        }
    },
    methods: {
        initMap: function(){            
            const mapEl = document.getElementById(this.mapName);
            const mapOpts = {
                center: this.center,
                zoom: this.zoom,
                mapTypeControl: false,
                streetViewControl: false,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.LEFT_TOP
                }
            }

            this.map = new google.maps.Map( mapEl, mapOpts);
        },
        initSearch: function() {
            if( !this.search ){
                return;
            }

            this.searchLat = document.getElementById(this.mapName + '-lat');
            this.searchLng = document.getElementById(this.mapName + '-lng');
            const searchEl = document.getElementById(this.mapName + '-search');


            this.searchBox = new google.maps.places.SearchBox( searchEl );
            this.searchBox.addListener('places_changed', this.centerMapOnSearch.bind(this));

            this.initSearchMarker();
                        
        },
        initSearchMarker: function() {

            this.searchMarker = new google.maps.Marker({
                position: this.center,                                
                zIndex:5,
                draggable:true,                
            });

            this.searchMarker.addListener('dragend', function(event){
                this.fillUpLatLng( event.latLng.lat, event.latLng.lng );
            }.bind(this));

            if( this.center.lat !== 0 || this.center.lng !== 0) {
                this.searchMarker.setMap( this.map );
            }
            
            
        },
        centerMapOnSearch: function() {
            const places = this.searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }

            const loc = places[0].geometry.location;
            const center = {lat: loc.lat(), lng: loc.lng()};

            this.map.setCenter( center );
            this.centerSearchMarker( center );
            this.fillUpLatLng( center.lat, center.lng );
            
        },
        centerSearchMarker: function( center ) {

            this.searchMarker.setPosition( center );

            if( !this.searchMarker.getMap() ) {
                this.searchMarker.setMap( this.map );
            }

            if( this.map.getZoom() <= 5) {
                this.map.setZoom(15);
            }
        },
        fillUpLatLng: function(lat, lng) {
            this.searchLat.value = lat;
            this.searchLng.value = lng;
        }
    }
}
</script>

<style scoped>
.gmap-wrapper {
    width:100%;
    position: relative;
}
.map-search {
    position: absolute;
    top:10px;
    left:50px;
    right:0;
    z-index: 9999;
    width: 45%;
}
</style>
