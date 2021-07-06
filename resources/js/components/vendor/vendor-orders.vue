<template>
    <div>
        <div class="container">
            <h2 class="CK-center-title">All Orders</h2>
            <table class="bg-light shadow-lg table table-bordered">
                <thead>
                <tr>
                    <th>
                        Order ID
                    </th>
                    <th>
                        Order Item
                    </th>
                    <th>
                        Order Date
                    </th>
                    <th>
                        View
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="order of orders">
                    <td>
                        #{{ order.order_id }}
                    </td>
                    <td>
                        {{ order.product.title }}
                    </td>
                    <td>
                        {{ order.created_at | formatDate }}
                    </td>
                    <td>
                        <a v-bind:href="/order-detail/+order.order_id" class="btn btn-outline-info">View Order</a>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>
                        Order ID
                    </th>
                    <th>
                        Order Item
                    </th>
                    <th>
                        Order Date
                    </th>
                    <th>
                        View
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "vendor-orders",
    props: ['userId','vendorId'],
    data() {
        return {
            orders: [],
            vendor: [],
        };
    },
    mounted() {
        this.showPreloader()
    },
    created() {
        this.getOrderInfo(this.vendorId)
        console.log(this.vendorId)
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
        getOrderInfo(vendorId) {
            axios.get('/getOrderByVendorId/' + vendorId).then((rp) => {
                    console.log(rp.data)
                    this.orders = rp.data
                    this.loader.hide()
                },
                (er) => {
                    console.log(er)
                })
        },
    }
}
</script>

<style scoped>

</style>
