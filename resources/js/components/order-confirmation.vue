<template>
    <div>
        <div class="container CK-order-receipt mt-2">
            <h2 class="text-center CK-center-title">Confirm your order</h2>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <h4>Order Summary</h4>
                        <span>Classic Tiffin Box</span>
                        <span>150 Rs per month</span>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <span>Subscription period</span>
                                <p>{{ formData.formData.validity }}</p>
                                <div class="inner" v-if="formData.formData.validity==='custom'">
                                    <span>{{ formData.formData.start_date }}</span>
                                    <span>{{ formData.formData.end_date }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <span>Repeat Time</span>
                                <ul>
                                    <li v-for="time of formData.formData.serve_time">{{ time }}</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <span>Addons</span>
                                <ul>
                                    <li v-for="addon of formData.formData.addon">{{ addon }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="inner-row">
                            <span>Monthly Updated Plan Amount - </span>
                            <span>150 rs</span>
                        </div>
                    </div>
                    <div class="card">
                        <h2>Confirm Address</h2>
                        <div class="edit-info form-group">
                            <label>
                                <textarea placeholder="Enter delivery address here" v-model="formData.delivery_address"
                                          cols="50" rows="5"></textarea>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card CK-payment-summary">
                        <h4>Payment Summary</h4>
                        <ul>
                            <li>
                                <span>Product Amount - </span>
                                <span>{{ formData.product_amount }} rs</span>
                            </li>
                            <li>
                                <span>GST - </span>
                                <span>{{ formData.gst_rate }} rs</span>
                            </li>
                            <li>
                                <span>Discount - </span>
                                <span>{{ formData.discount_amount }}% Off</span>
                            </li>
                            <li>
                                <span>Total - </span>
                                <span>158 rs</span>
                            </li>
                            <li>
                                <input type="checkbox" name="agreed_policy" v-bind:checked="formData.agreed_policy"
                                       @click="isAgreed">
                                <label>Agree the terms & conditions?</label>
                            </li>
                            <li>
                                <button class="btn btn-success btn-lg" @click="getOrderID">Proceed to pay</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from "vue";

export default {
    name: "order-confirmation",
    data() {
        return {
            loginUri: null,
            isCurrentUser: false,
            isCustomOpt: false,
            currentUser: '',
            orderID: '',
            grandTotal: '',
            formData: []
        };
    },
    created() {
        this.formData = JSON.parse(localStorage.getItem('order-cart'))
        this.formData.gst_rate = 10
        this.formData.discount_amount = 45
        this.formData.coupon_code = 'first20'
        this.formData.agreed_policy = 0
        this.formData.delivery_address = 'B Block, Haridwar, UK 249402'
        this.formData.order_total = this.formData.product_amount + this.formData.gst_rate + this.formData.discount_amount
        console.log(this.formData)
        window.addEventListener('onPaymentSuccess', (e) => {
            this.formData.pay_id = e.detail.payment_id
            this.addSubscribtion()
        });
    },
    methods: {
        showPreloader() {
            this.loader = this.$loading.show({
                canCancel: true,
                onCancel: this.onCancel,
                color: '#ffffff',
                loader: 'dots',
                backgroundColor: '#000000',
            });
        },
        isAgreed() {
            this.formData.agreed_policy =! this.formData.agreed_policy
        },

        addSubscribtion() {
            this.showPreloader()
            this.formData.order_id = this.orderID
            axios.post('/addSubscription', this.formData)
                .then(res => {
                    console.log(res.data);
                    this.loader.hide()
                    $('.modal').modal('hide')
                    let instance = Vue.$toast.open({
                        message: res.data.message,
                        type: res.data.responseType,
                    });
                    if (instance) {
                        window.location = '/order-detail/' + this.orderID
                    }
                }).catch(er => {
                console.log(er);
            })
        },

        getOrderID() {
            if (!this.formData.agreed_policy) {
                alert('Please agree term & policy')
                return false
            }
            axios.get('/paytest/' + this.formData.vendorId + '/' + this.formData.userId + '/' + this.formData.productId)
                .then(res => {
                    console.log(res.data);
                    if (res.data.responseType) {
                        let instance = Vue.$toast.open({
                            message: res.data.message,
                            type: res.data.responseType,
                        });
                        return false
                    }
                    this.orderID = res.data.orderID
                    if (res.data.orderID) {
                        this.pay(res.data.orderID)
                    }
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

        pay(orderID) {
            var options = {
                "key": "rzp_test_fVUykSh2DqZuiy", // Enter the Key ID generated from the Dashboard
                "amount": "50000", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": "Acme Corp",
                "description": "Test Transaction",
                "image": "https://cookrey.com/images/shade-logo.png",
                "order_id": orderID, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                "handler": function (response) {
                    console.log(response)
                    let instance = Vue.$toast.open({
                        message: 'Payment Successful!',
                        type: 'success',
                    });
                    window.dispatchEvent(new CustomEvent('onPaymentSuccess', {'detail': {'payment_id': response.razorpay_payment_id}}));
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
                console.log(response.error.code, response.error.description,
                    response.error.source, response.error.step,
                    response.error.reason, response.error.metadata.order_id,
                    response.error.metadata.payment_id);
                let instance = Vue.$toast.open({
                    message: 'Payment Failed!',
                    type: 'error',
                });
            });
            rzp1.open();
        },


    }
}
</script>

<style scoped>

</style>
