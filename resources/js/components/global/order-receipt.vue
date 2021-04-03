<template>
    <div>
        <div class="container CK-order-receipt mt-2">
            <h2 class="text-center CK-center-title">Thank you! You Subscription Done.</h2>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <span>Order ID - #{{this.order_id}}</span>
                        <h4>Order Summary</h4>
                        <span>Classic Tiffin Box</span>
                        <span>{{ this.order.product_amount }} Rs per month</span>
                        <hr>
                        <div class="row" v-if="this.order.subscription">
                            <div class="col-md-4">
                                <span>Subscription period</span>
                                <p>{{ this.order.subscription.validity }}</p>
                                <div class="inner" v-if="order.subscription.validity==='custom'">
                                    <span>{{ order.subscription.start_date }}</span>
                                    <span>{{ order.subscription.end_date }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <span>Repeat Time</span>
                                <ul>
                                    <li v-for="time of order.subscription.serve_time">{{ time }}</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <span>Addons</span>
                                <ul>
                                    <li v-for="addon of order.subscription.addon">{{ addon }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="inner-row">
                            <span>Monthly Updated Plan Amount - </span>
                            <span>{{ this.order.product_amount }} rs</span>
                        </div>
                    </div>
                    <div class="card">
                        <h4>Delivery Address</h4>
                        <p>{{ this.order.delivery_address }} </p>

                        <h4>Payment Method</h4>
                        <span>{{ this.order.payment_mode }} </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card CK-payment-summary">
                        <h4>Payment Summary</h4>
                        <ul>
                            <li>
                                <span>Product Amount - </span>
                                <span>{{ this.order.product_amount }} rs</span>
                            </li>
                            <li>
                                <span>GST - </span>
                                <span>{{ this.order.gst_rate }}  rs</span>
                            </li>
                            <li>
                                <span>Discount - </span>
                                <span>{{ this.order.discount_amount }}% Off</span>
                            </li>
                            <li>
                                <span>Total - </span>
                                <span>{{ this.order.order_total }}  rs</span>
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
    name: "order-receipt",
    props: ['order_id'],
    data() {
        return {
            loginUri: null,
            isCurrentUser: false,
            isCustomOpt: false,
            currentUser: '',
            grandTotal: '',
            order: []
        };
    },
    mounted() {
        this.showPreloader()
        console.log(this.order_id)
        this.getOrderById()
    },
    created() {

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

        getOrderById() {
            axios.get('/getOrderById/' + this.order_id)
                .then(res => {
                    console.log(res.data);
                    this.loader.hide()
                    this.order = res.data[0]
                    const addons = this.order.subscription.addon.split(',')
                    const serve_time = this.order.subscription.serve_time.split(',')
                    this.order.subscription.addon = addons
                    this.order.subscription.serve_time = serve_time
                    console.log(this.order);
                }).catch(er => {
                console.log(er.data);
            })
        }

    }
}
</script>

<style scoped>

</style>
