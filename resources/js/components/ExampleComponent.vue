<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="map" style="width: 100%;height: 100%;"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            mapName: "map",
        }
    },

    mounted() {
        this.initMap();
    },
    methods: {
        // Iniitialize map without creating markers
        initMap: function () {
            var mapOptions =
                {
                    zoom: 6,
                    center: {
                        lat: 34.652500,
                        lng: 135.506302
                    }
                };

            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({address: 'bahadrabad'}, (results, status) => {
                console.log(results);
            });
        },

        // Helper method to insert markers
        // insertMarkers: function () {
        //     var marker = new google.maps.Marker({
        //         map: map,
        //         icon: 'imgs/marker.png',
        //         url: "/pages/estates.id",
        //         label: {
        //             text: this.estates.price,
        //             color: "#fff",
        //         },
        //         position: {
        //             lat: this.estates.lat,
        //             lng: this.estates.lng
        //         }
        //     });
        //
        //     google.maps.event.addListener(marker, 'click', function () {
        //         window.location.href = this.url;
        //     });
        // }
    },
}
</script>
