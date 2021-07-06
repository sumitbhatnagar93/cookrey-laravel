<template>
    <div>
        <section id="about" class="container-fluid text-white bg-danger p-5 text-center">
            <div class="container">
                <h2>About Us</h2>
                <p>For us, it's not just about bringing you good food from your favourite restaurants. It's about making
                    a connection,
                    which is why we sit down with the chefs, dreaming up menus that will arrive fresh and full of
                    flavour. Try us!</p>
            </div>
        </section>
        <div class="container CKSV-main">
            <div class="section-title text-center m-4 text-muted">
                <div class="">
                    <h2 class="CK-center-title">Find Nearest Vendor</h2>
                    <div class="desc-see-more-link">
                        <h6 class="sc-1gbvc19-0 bPGePZ desc">Explore curated lists of top restaurants, cafes, pubs, and
                            bars in Haridwar,
                            based on trends</h6>
                        <a href="/haridwar/collections" tabindex="0" color="#F57082"
                           class="ks3f96-0 cFSkbc sc-jAWRmi eKxScq" target="_self" role="link">
                            <span tabindex="-1"
                                  color="#F57082"
                                  target="_self"
                                  role="link"
                                  class="ks3f96-1 iFQLJx">All collections in Haridwar
                                <!-- --> <i class="rbbb40-1 MxLSp sc-igaqVs jqgDvY" color="#F57082" size="12"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="#F57082" width="12" height="12"
                                    viewBox="0 0 20 20" aria-labelledby="icon-svg-title- icon-svg-desc-" role="img"
                                    class="rbbb40-0 fQZfgq"><title>right-triangle</title><path
                                    d="M5 0.42l10 10-10 10v-20z"></path></svg></i></span></a></div>
                </div>
            </div>
            <div class="row">
                <div class="owl-carousel">
                    <div v-for="(vendor,index) of cookreyVendors" class="card CKRW-item">
                        <div class="mad-entity-media">
                            <img v-bind:src="'/images/'+vendor.business_image"
                                 alt="restaurant-placeholder" v-if="vendor.business_image === 'placeholder.jpg'">
                            <img v-bind:src="'/images/restaurants/'+vendor.provider_id+'/'+vendor.business_image"
                                 alt="restaurant" v-if="vendor.business_image !== 'placeholder.jpg'">
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
                            <a v-bind:href="'vendor/'+vendor.provider_id" class="btn btn-outline-success">Subscribe
                                Now</a>
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
        <section class="apk-banner"></section>
        <section class="vendor-area container p-3">
            <h2 class="text-muted">Cities We Deliver To</h2>
            <div class="CKHM-areas text-center">
                <a href="#/ncr/" class="inline-list bXAMUA">Delhi NCR</a>
                <a href="#/kolkata/" class="inline-list bXAMUA">Kolkata</a>
                <a href="#/mumbai/" class="inline-list bXAMUA">Mumbai</a>
                <a href="#/bangalore/" class="inline-list bXAMUA">Bengaluru</a>
                <a href="#/pune/" class="inline-list bXAMUA">Pune</a>
                <a href="#/hyderabad/" class="inline-list bXAMUA">Hyderabad</a>
                <a href="#/chennai/" class="inline-list bXAMUA">Chennai</a>
                <a href="#/lucknow/" class="inline-list bXAMUA">Lucknow</a>
                <a href="#/kochi/" class="inline-list bXAMUA">Kochi</a>
                <a href="#/jaipur/" class="inline-list bXAMUA">Jaipur</a>
                <a href="#/ahmedabad/" class="inline-list bXAMUA">Ahmedabad</a>
                <a href="#/chandigarh/" class="inline-list bXAMUA">Chandigarh</a>
                <a href="#/indore/" class="inline-list bXAMUA">Indore</a>
                <a href="#/shimla/" class="inline-list bXAMUA">Shimla</a>
                <a href="#/ludhiana/" class="inline-list bXAMUA">Ludhiana</a>
                <a href="#/guwahati/" class="inline-list bXAMUA">Guwahati</a>
                <a href="#/amritsar/" class="inline-list bXAMUA">Amritsar</a>
                <a href="#/kanpur/" class="inline-list bXAMUA">Kanpur</a>
                <a href="#/allahabad/" class="inline-list bXAMUA">Allahabad</a>
                <a href="#/aurangabad/" class="inline-list bXAMUA">Aurangabad</a>
                <a href="#/bhopal/" class="inline-list bXAMUA">Bhopal</a>
                <a href="#/ranchi/" class="inline-list bXAMUA">Ranchi</a>
                <a href="#/visakhapatnam/" class="inline-list bXAMUA">Visakhapatnam</a>
                <a href="#/bhubaneswar/" class="inline-list bXAMUA">Bhubaneswar</a>
                <a href="#/coimbatore/" class="inline-list bXAMUA">Coimbatore</a>
                <a href="#/mangalore/" class="inline-list bXAMUA">Mangalore</a>
                <a href="#/vadodara/" class="inline-list bXAMUA">Vadodara</a>
                <a href="#/nagpur/" class="inline-list bXAMUA">Nagpur</a>
                <a href="#/agra/" class="inline-list bXAMUA">Agra</a>
                <a href="#/dehradun/" class="inline-list bXAMUA">Dehradun</a>
                <a href="#/mysore/" class="inline-list bXAMUA">Mysore</a>
                <a href="#/puducherry/" class="inline-list bXAMUA">Puducherry</a>
                <a href="#/surat/" class="inline-list bXAMUA">Surat</a>
                <a href="#/varanasi/" class="inline-list bXAMUA">Varanasi</a>
                <a href="#/patna/" class="inline-list bXAMUA">Patna</a>
                <a href="#/udaipur/" class="inline-list bXAMUA">Udaipur</a>
                <a href="#/cuttack/" class="inline-list bXAMUA">Cuttack</a>
                <a href="#/trivandrum/" class="inline-list bXAMUA">Trivandrum</a>
                <a href="#/haridwar/" class="inline-list bXAMUA">Haridwar</a>
                <a href="#/leh/" class="inline-list bXAMUA">Leh</a>
                <a href="#/pushkar/" class="inline-list bXAMUA">Pushkar</a>
                <a href="#/rajkot/" class="inline-list bXAMUA">Rajkot</a>
                <a href="#/madurai/" class="inline-list bXAMUA">Madurai</a>
                <a href="#/kozhikode/" class="inline-list bXAMUA">Kozhikode</a>
                <a href="#/alappuzha/" class="inline-list bXAMUA">Alappuzha</a>
                <a href="#/thrissur/" class="inline-list bXAMUA">Thrissur</a>
                <a href="#/manipal/" class="inline-list bXAMUA">Manipal</a>
                <a href="#/vijayawada/" class="inline-list bXAMUA">Vijayawada</a>
                <a href="#/jodhpur/" class="inline-list bXAMUA">Jodhpur</a>
                <a href="#/kota/" class="inline-list bXAMUA">Kota</a>
                <a href="#/ajmer/" class="inline-list bXAMUA">Ajmer</a>
                <a href="#/mussoorie/" class="inline-list bXAMUA">Mussoorie</a>
                <a href="#/rishikesh/" class="inline-list bXAMUA">Rishikesh</a>
                <a href="#/jalandhar/" class="inline-list bXAMUA">Jalandhar</a>
                <a href="#/jammu/" class="inline-list bXAMUA">Jammu</a>
                <a href="#/manali/" class="inline-list bXAMUA">Manali</a>
                <a href="#/dharamshala/" class="inline-list bXAMUA">Dharamshala</a>
                <a href="#/raipur/" class="inline-list bXAMUA">Raipur</a>
                <a href="#/gorakhpur/" class="inline-list bXAMUA">Gorakhpur</a>
                <a href="#/palakkad/" class="inline-list bXAMUA">Palakkad</a>
                <div class="sc-biNVYa iapRVw"><a href="#/delivery-cities" class="sc-haEqAx gSlADi">See more</a>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import StarRating from "vue-star-rating";
import Vue from 'vue';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueToast);
export default {
    name: "homeComponent",
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
