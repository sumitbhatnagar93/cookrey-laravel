<template>
    <div>
        <div tabindex="-1" class="sc-ipZHIp CKHM-srchmain">
            <div class="sc-ipXKqB CKHM-srch-wrapper">
                <div class="sc-18n4g8v-0 gAhmYY sc-clNaTc wrapper-inner" style="font-size: 23px;color: dimgrey;">
                    <i class="rbbb40-1 MxLSp" @click="onSelectLocation" color="#ED5A6B" size="20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#ED5A6B" width="20" height="20"
                             viewBox="0 0 20 20" aria-labelledby="icon-svg-title- icon-svg-desc-"
                             role="img" class="rbbb40-0 kIxlGM"><title>current-location</title>
                            <path
                                d="M13.58 10c0 1.977-1.603 3.58-3.58 3.58s-3.58-1.603-3.58-3.58c0-1.977 1.603-3.58 3.58-3.58v0c1.977 0 3.58 1.603 3.58 3.58v0zM20 9.52v0.96c0 0.265-0.215 0.48-0.48 0.48v0h-1.72c-0.447 3.584-3.256 6.393-6.802 6.836l-0.038 0.004v1.72c0 0.265-0.215 0.48-0.48 0.48v0h-0.96c-0.265 0-0.48-0.215-0.48-0.48v0-1.72c-3.575-0.455-6.375-3.262-6.816-6.802l-0.004-0.038h-1.74c-0.265 0-0.48-0.215-0.48-0.48v0-0.96c0-0.265 0.215-0.48 0.48-0.48v0h1.74c0.445-3.578 3.245-6.385 6.781-6.836l0.039-0.004v-1.72c0-0.265 0.215-0.48 0.48-0.48v0h0.96c0.265 0 0.48 0.215 0.48 0.48v0 1.72c3.584 0.447 6.393 3.256 6.836 6.802l0.004 0.038h1.72c0.265 0 0.48 0.215 0.48 0.48v0zM15.96 10c0-3.292-2.668-5.96-5.96-5.96s-5.96 2.668-5.96 5.96c0 3.292 2.668 5.96 5.96 5.96v0c3.292 0 5.96-2.668 5.96-5.96v0z"></path>
                        </svg>
                    </i>
                    <input value="" id="autocomplete" v-model="address" placeholder="Haridwar"
                           class="sc-etwtAo search-input">
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="sc-VJcYb dtzfDv"></div>
                <div class="sc-18n4g8v-0 gAhmYY sc-kUaPvJ dPcESM">
                    <input value=""
                           placeholder="Search for your favourite vendor.."
                           class="sc-fONwsr lbMFPq">
                    <div class="sc-jVODtj hjtbhk">
                        <i class="fa fa-search" style="font-size: 23px;color: dimgrey;"></i>
                    </div>
                    <div class="sc-hGoxap ckBgCS"></div>
                </div>
            </div>
        </div>
        <div class="autocomplete" v-if="autocompleteItems.length === 0">
            <ul>
                <li v-for="(item,index) of autocompleteItems">{{ item.description }}</li>
            </ul>
        </div>
    </div>

</template>

<script>
export default {
    name: "searchComponent",
    data() {
        return {
            address: '',
            location: [],
            autocomplete: {input: ''},
            autocompleteItems: [],
        }
    },
    created() {
        google.maps.event.addDomListener(window, 'load', this.initialize);
        this.onInit();
    },
    methods: {
        initialize() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);
            console.log(autocomplete)
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                console.log(place.place_id)
                localStorage.setItem('currentLocation', JSON.stringify(place));
                window.dispatchEvent(new CustomEvent('reloadListing'));
            });
        },

        onInit() {
        },
        onSelectLocation() {

            // const geocoder = new google.maps.Geocoder();
            // const currentLocation = new google.maps.LatLng(29.8543, 77.8880);
            // geocoder.geocode({location: currentLocation}, (results, status) => {
            //     console.log(results)
            //     this.address = results[0].address_components[4]['long_name'] + ', ' + results[0].address_components[5]['long_name'] + ', ' + results[0].address_components[6]['long_name']
            //     console.log(this.address)
            //     localStorage.setItem('currentLocation', JSON.stringify(results[0]));
            //     window.dispatchEvent(new CustomEvent('reloadListing'));
            // });

            if (navigator.geolocation) {
                const location = navigator.geolocation.getCurrentPosition(this.showPosition);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        },
        showPosition(position) {
            const geocoder = new google.maps.Geocoder();
            let lat = position.coords.latitude
            let lng = position.coords.longitude
            const currentLocation = new google.maps.LatLng(26.8467088, 80.9461592);
            geocoder.geocode({location: currentLocation}, (results, status) => {
                console.log(results)
                this.address = results[0].address_components[4]['long_name'] + ', ' + results[0].address_components[5]['long_name'] + ', ' + results[0].address_components[6]['long_name']
                console.log(this.address)
                localStorage.setItem('currentLocation', JSON.stringify(results[0]));
                window.dispatchEvent(new CustomEvent('reloadListing'));
            });
            console.log(position)
        },
        // onChange() {
        //     const GoogleAutocomplete = new google.maps.places.AutocompleteService();
        //     if (this.autocomplete.input === '') {
        //         this.autocompleteItems = [];
        //         return;
        //     }
        //     GoogleAutocomplete.getPlacePredictions({
        //             input: this.autocomplete.input,
        //             componentRestrictions: {
        //                 country: 'IN'
        //             }
        //         },
        //         (predictions, status) => {
        //             this.autocompleteItems = [];
        //             console.log(predictions)
        //             // this.zone.run(() => {
        //             //     predictions.forEach((prediction) => {
        //             //         this.autocompleteItems.push(prediction);
        //             //     });
        //             // });
        //         });
        // }
    },
}
</script>

<style scoped>

</style>
