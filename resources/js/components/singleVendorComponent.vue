<template>
    <div>
        <div class="container CK-vendor-single">
            <h2 class="CK-center-title m-4">Select Your favorite tiffin box</h2>
            <div class="row">
                <div class="card font-weight-bolder mb-3 text-muted text-white">
                    <div class="card-header">Rs. 50/ per
                        tiffin
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">In the Box</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <p class="card-text">Dal | Roti | Rice | Salad</p>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-info" @click="pay">Subscribe now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card font-weight-bolder mb-3 text-muted text-white">
                    <div class="card-header">Rs. 50/ per
                        tiffin
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">In the Box</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <p class="card-text">Dal | Roti | Rice | Salad</p>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-info">Subscribe now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card font-weight-bolder mb-3 text-muted text-white">
                    <div class="card-header">Rs. 50/ per
                        tiffin
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">In the Box</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <p class="card-text">Dal | Roti | Rice | Salad</p>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-info">Subscribe now</button>
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
    name: "singleVendorComponent",
    data() {
        return {
            orderID: ''
        };
    },
    created() {
        this.getOrderID();
    },
    methods: {
        getOrderID() {
            axios.get('/paytest')
                .then(res => {
                    console.log(res.data);
                    this.orderID = res.data.orderID
                }).catch(er => {
                console.log(er);
            })
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
        }
    }
}
</script>
<style scoped>

</style>
