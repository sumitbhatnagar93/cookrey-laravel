<template>
    <div>
        <div class="main-banner text-white text-center front-banner"
             style="background-image: url('/images/banner.jpeg')">
            <h1 class="text-white">{{ vendor.business_name }}</h1>
            <div class="meta-info">
                <span>{{ vendor.business_address }}</span><br>
                <span>{{ vendorDistance }} Km | 3.4 ratings</span>
            </div>
        </div>
        <div class="container CK-vendor-single">
            <div class="row">
                <div class="col-md-3">
                    <div class="main-sidebar">
                        <div class="rating-area">
                            <div class="card" style="width: 100%;text-align: center;margin-top: 85px;height: 100px;">
                                <div class="inner-row">
                                    <span>{{ vendor.feedback_rating }} Ratings</span>
                                    <div data-toggle="modal" v-bind:data-target="'#ratingModal'+slug">
                                        <star-rating style="pointer-events: none;"
                                                     v-bind:showRating="false"
                                                     v-bind:increment="0.5"
                                                     v-bind:star-size="40" v-model="ratings">
                                        </star-rating>
                                    </div>
                                </div>
                                <div class="CKmnt-area">
                                    <ul>
                                        <li></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <h2 class="CK-center-title m-4">Select Your favorite tiffin box</h2>
                    <div class="row">
                        <div v-for="product of products" class="card font-weight-bolder mb-3 text-muted text-white">
                            <div class="card-header">
                                Rs. {{ product.price }}/ per tiffin
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">In the Box</h5>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card-text">
                                        <ul class="box-items">
                                            <li v-for="items of (JSON.parse(product.in_the_box))">{{items}}</li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-outline-info" data-toggle="modal"
                                                data-target="#exampleModal"
                                                data-whatever="@getbootstrap">Subscribe now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="sampleData text-center">
                        <h2 class="CK-center-title">Our Menu</h2>
                        <a href="/images/sample-services.jpg" data-fancybox data-caption="Our Daily Menu">
                            <img src="/images/sample-services.jpg" alt="sample"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" v-bind:id="'ratingModal'+slug" tabindex="-1" role="dialog"
             aria-labelledby="ratingModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div v-if="isCurrentUser" class="modal-body">
                        <form @submit.prevent="addRating(slug,ratings)"
                              v-bind:id="'ratingForm'+vendor.provider_id">
                            <div class="form-group">
                                <h4>Add your valuable rating</h4>
                                <div class="rating-system text-center">
                                    <star-rating v-model="ratings"
                                                 :increment="0.5"></star-rating>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="feedback_msg" placeholder="Feedback"
                                          v-bind:id="'feedbackMsg'+slug" cols="50"
                                          rows="4"></textarea>
                            </div>
                            <button class="btn btn-dark">Cancel</button>
                            <button class="btn btn-success">Submit</button>
                        </form>
                    </div>
                    <div v-if="!isCurrentUser" class="modal-body text-center">
                        <a v-bind:href="loginUri" class="btn btn-info">Login now</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Subscribe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <h4>Select you subscription period</h4>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio" checked @click="isDefaultOption">Week
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio" @click="isDefaultOption">Month
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id="custom-option" @click="isCustomOption" name="optradio">Custom
                                </label>
                                <div class="custom-opt" v-if="isCustomOpt">
                                    <label for="from">
                                        <span>From:</span>
                                        <input type="date" class="form-control" id="from">
                                    </label>
                                    <label for="to">
                                        <span>To:</span>
                                        <input type="date" class="form-control" id="to">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                           value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">Lunch</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                           value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">Dinner</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <h4>Choose Addons</h4>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3"
                                           value="option1">
                                    <label class="form-check-label" for="inlineCheckbox3">Lunch</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox4"
                                           value="option2">
                                    <label class="form-check-label" for="inlineCheckbox4">Dinner</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox5"
                                           value="option2">
                                    <label class="form-check-label" for="inlineCheckbox5">Dinner</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox6"
                                           value="option2">
                                    <label class="form-check-label" for="inlineCheckbox6">Dinner</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" @click="pay">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import fancybox from "@fancyapps/fancybox"
import StarRating from 'vue-star-rating';
import Vue from "vue";

export default {
    name: "singleVendorComponent",
    components: {
        StarRating,
    },
    props: ['auth_info'],
    data() {
        return {
            loginUri: null,
            isCurrentUser: false,
            isCustomOpt: false,
            currentUser: '',
            orderID: '',
            grandTotal: '',
            vendor: [],
            vendorDistance: null,
            cart: '',
            currentLocation: [],
            products: [],
            ratings: 0,
            slug: ''
        };
    },
    mounted() {
        this.showPreloader()
        console.log(this.auth_info)
        if (this.auth_info['auth_token']) {
            this.isCurrentUser = true
        }
        this.slug = this.auth_info['vendor_id']
        this.loginUri = this.auth_info['login_uri']
        this.getVendorById()
    },
    created() {
        this.getOrderID();
    },
    methods: {
        getVendorById() {
            const localData = localStorage.getItem('currentLocation')
            if (localData) {
                this.currentLocation = JSON.parse(localData)
            } else {
                this.currentLocation.place_id = 'ChIJGVGzCG6zDjkRcgq9XsJdj3k'
            }
            let lat = this.currentLocation.geometry.location.lat
            let lng = this.currentLocation.geometry.location.lng
            axios('/getVendorByIdWithFeed/' + this.slug).then((res) => {
                console.log(JSON.parse(res.data[0].services_product[0].in_the_box))
                this.vendor = res.data[0]
                this.products = res.data[0].services_product
                let rating = res.data[0].avg_rating;
                this.ratings = rating.length ? rating[0].rating : 0
                this.getKmDistance(res.data[0], lat, lng).then((inp) => {
                    this.vendorDistance = inp
                    this.loader.hide()
                })
            })
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
        async getKmDistance(data, lat, lng) {
            const geocoder = new google.maps.Geocoder();
            const from = new google.maps.LatLng(lat, lng);
            const to = new google.maps.LatLng(data.lat, data.lng);
            const dist = google.maps.geometry.spherical.computeDistanceBetween(from, to);
            const km = (dist / 1000).toFixed(1);
            return km
        },
        getOrderID() {
            axios.get('/paytest')
                .then(res => {
                    console.log(res.data);
                    this.orderID = res.data.orderID
                }).catch(er => {
                console.log(er);
            })
        },
        isDefaultOption() {
            this.isCustomOpt = false
        },
        isCustomOption() {
            this.isCustomOpt = true
        },
        pay() {
            var options = {
                "key": "rzp_test_OPZe4wbtYoUrsI", // Enter the Key ID generated from the Dashboard
                "amount": "50000", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": "Acme Corp",
                "description": "Test Transaction",
                "image": "https://example.com/your_logo",
                "order_id": this.orderID, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                "handler": function (response) {
                    alert(response.razorpay_payment_id);
                    alert(response.razorpay_order_id);
                    alert(response.razorpay_signature)
                },
                prefill: {
                    email: 'demopay@sunilk.work',
                    contact: '123456789',
                    name: 'Ionic Razorpay Demo'
                },
                "notes": {
                    "address": "Razorpay Corporate Office"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response) {
                alert(response.error.code);
                alert(response.error.description);
                alert(response.error.source);
                alert(response.error.step);
                alert(response.error.reason);
                alert(response.error.metadata.order_id);
                alert(response.error.metadata.payment_id);
            });
            rzp1.open();
        },

        addRating(vendorID, rating) {
            this.showPreloader()
            let formData = new FormData(document.getElementById('ratingForm' + vendorID));
            formData.append('feedback_rating', rating)
            formData.append('vendor_id', vendorID)
            axios.post('/add-rating', formData)
                .then(res => {
                    console.log(res.data);
                    $('#ratingModal' + vendorID).modal('hide')
                    this.loader.hide()
                    let instance = Vue.$toast.open({
                        message: res.data.message,
                        type: res.data.responseType,
                    });
                }).catch(er => {
                console.log(er.data);
            })
        }
    }
}
</script>
<style scoped>

</style>
