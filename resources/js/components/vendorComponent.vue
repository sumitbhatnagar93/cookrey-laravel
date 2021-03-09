<template>
    <div>
        <div class="container CKSV-main">
            <search-component></search-component>
            <div class="section-title text-muted">
                <h2 class="position-relative">Collections</h2>
            </div>
            <h4 class="text-center" v-if="cookreyVendors.length==0">No Service Found :(</h4>
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
                        <div class="CKLST-submeta float-right">
                            <span class="CK-distance">{{ vendor.rating }} ratings</span>
                            <div class="stars">
                                <star-rating v-bind:increment="0.5" v-model="vendor.rating"
                                             v-bind:showRating="false"
                                             v-bind:star-size="20" style="pointer-events: none;">
                                </star-rating>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import StarRating from 'vue-star-rating';
import Vue from 'vue';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueToast);
export default {
    name: "vendorComponent",
    components: {
        StarRating,
    },
    props: ['auth_info'],
    data() {
        return {
            loginUri: null,
            isCurrentUser: false,
            rating: 0,
            isRated: false,
            loader: [],
            vendors: [],
            cookreyVendors: [],
            currentLocation: [],
        }
    },
    mounted() {
        this.showPreloader()
        if (this.auth_info['auth_token']) {
            this.isCurrentUser = true
        }
        this.loginUri = this.auth_info['login_uri']
    },
    created() {
        this.onInit();
        this.currentLocation.lat = 29.8543
        this.currentLocation.lng = 77.8880
        window.addEventListener('reloadListing', () => {
            this.showPreloader()
            this.onInit()
        })
    },
    methods: {
        async onInit() {
            const localData = localStorage.getItem('currentLocation')
            if (localData) {
                this.currentLocation = JSON.parse(localData)
            } else {
                this.currentLocation.place_id = 'ChIJGVGzCG6zDjkRcgq9XsJdj3k'
            }
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({placeId: this.currentLocation.place_id}, (results, status) => {
                this.currentLocation.lat = results[0].geometry.location.lat()
                this.currentLocation.lng = results[0].geometry.location.lng()
                axios('getVendors').then((res) => {
                    console.log(res.data)
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
            //    for (const index, value of data) {
            Object.entries(data).forEach(([key, value]) => {
                const from = new google.maps.LatLng(lat, lng);
                const to = new google.maps.LatLng(value.lat, value.lng);
                const dist = google.maps.geometry.spherical.computeDistanceBetween(from, to);
                const km = (dist / 1000).toFixed(1);
                if (value.avg_rating.length === 1) {
                    value.rating = value.avg_rating[0].rating
                } else {
                    value.rating = 0
                }
                if (parseInt(km) <= 5 && value.services_product.length) {
                    this.cookreyVendors.push(value)
                }
            })
            console.log(this.cookreyVendors)
        },

    }
}
</script>

<style scoped>

</style>
