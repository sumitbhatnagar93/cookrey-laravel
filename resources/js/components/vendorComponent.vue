<template>
    <div>

        <div class="container CKSV-main">
            <search-component></search-component>
            <div class="section-title text-muted">
                <h2 class="position-relative">Collections</h2>
            </div>
            <div class="row">
                <div v-for="(vendor,index) of cookreyVendors" class="card CKRW-item">
                    <div class="mad-entity-media">
                        <img v-bind:src="'/images/restaurants/'+vendor.provider_id+'/'+vendor.business_image"
                             alt="restaurant">
                    </div>
                    <div class="meta-info m-3">
                        <h3>{{ vendor.business_name }}</h3>
                        <p>We provide best tiffin box and it will give you home food feel.</p>
                        <span>Rs.50/ per tiffin</span>
                        <br></br>
                        <span>
                             <i class="fas fa-map-marker-alt"></i>
                            {{ vendor.business_address.substring(0, 20) + ".." }}
                        </span>
                        <span class="float-right"><i class="fas fa-walking"></i> 5 Km</span>
                        <hr>
                        <a v-bind:href="'vendor/'+vendor.provider_id" class="btn btn-outline-success">Subscribe Now</a>
                        <a href="#" class="btn btn-outline-info">Explore more</a>
                        <div class="CKLST-submeta float-right">
                            <span class="CK-distance">5.4 ratings</span>
                            <div class="stars">
                                <i class="far fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "vendorComponent",
    data() {
        return {
            loader: [],
            vendors: [],
            cookreyVendors: [],
            currentLocation: [],
        }
    },
    created() {
        this.onInit();
        window.addEventListener('reloadListing', () => {
            this.showPreloader()
            this.onInit()
        })
    },
    methods: {
        async onInit() {
            this.currentLocation = JSON.parse(localStorage.getItem('currentLocation'))
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({placeId: this.currentLocation.place_id}, (results, status) => {
                this.currentLocation.lat = results[0].geometry.location.lat()
                this.currentLocation.lng = results[0].geometry.location.lng()
                axios('getVendors').then((res) => {
                    this.vendors = res.data
                    this.sortList(res.data, this.currentLocation.lat, this.currentLocation.lng).then(() => {
                        this.loader.hide()
                    });
                })
            });
        },

        showPreloader() {
            this.loader = this.$loading.show({
                canCancel: true,
                onCancel: this.onCancel,
                color: '#ffffff',
                loader: 'dots',
                backgroundColor: '#000000',
            });
        },
        async geoCode(placeId) {
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({placeId: placeId}, (results, status) => {
                this.currentLocation.lat = results[0].geometry.location.lat()
                this.currentLocation.lng = results[0].geometry.location.lng()
            });
        },

        async sortList(data, lat, lng) {
            this.cookreyVendors = [];
            const geocoder = new google.maps.Geocoder();
            for (const value of data) {
                const from = new google.maps.LatLng(lat, lng);
                const to = new google.maps.LatLng(value.lat, value.lng);
                const dist = google.maps.geometry.spherical.computeDistanceBetween(from, to);
                const km = (dist / 1000).toFixed(1);
                if (parseInt(km) <= 5) {
                    this.cookreyVendors.push(value);
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
