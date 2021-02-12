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
            vendors: [],
            cookreyVendors: []
        }
    },
    created() {
        this.onInit();
    },
    methods: {
        onInit() {
            axios('getVendors').then((res) => {
                console.log(res.data)
                this.vendors = res.data
                this.sortList(res.data, 29.8543, 77.8880).then(() => {
                    console.log('sorted')
                    console.log(this.cookreyVendors)
                });
            })
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
