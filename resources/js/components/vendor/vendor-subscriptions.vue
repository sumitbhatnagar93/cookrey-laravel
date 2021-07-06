<template>
    <div>

        <div class="container">
            <h2 class="CK-center-title">All Products</h2>
            <table class="bg-light shadow-lg table table-bordered">
                <thead>
                <tr>
                    <th>
                        SubID
                    </th>
                    <th>
                        Product ID
                    </th>
                    <th>
                        UserID
                    </th>
                    <th>
                        Validity
                    </th>
                    <th>
                        Start Date
                    </th>
                    <th>
                        End Date
                    </th>
                    <th>
                        Addons
                    </th>
                    <th>
                        Serve Time
                    </th>
                    <th>
                        Cancel Date
                    </th>
                    <th>
                        Created Date
                    </th>
                    <th>
                        View Product
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="sub of subscriptions">
                    <td>
                        #{{ sub.id }}
                    </td>
                    <td>
                        #{{ sub.productId }}
                    </td>
                    <td>
                        #{{ sub.userId }}
                    </td>
                    <td>
                        {{ sub.validity }}
                    </td>
                    <td>
                        {{ sub.start_date }}
                    </td>
                    <td>
                        {{ sub.end_date }}
                    </td>
                    <td>
                        {{ sub.addon | JSON }}
                    </td>
                    <td>
                        {{ sub.serve_time }}
                    </td>
                    <td>
                        {{ sub.cancel_dates }}
                    </td>
                    <td>
                        {{ sub.created_at | formatDate }}
                    </td>
                    <td>
                        <a v-bind:href="/update-product/+sub.id" class="btn btn-outline-info">View</a>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>
                        SubID
                    </th>
                    <th>
                        Product ID
                    </th>
                    <th>
                        UserID
                    </th>
                    <th>
                        Validity
                    </th>
                    <th>
                        Start Date
                    </th>
                    <th>
                        End Date
                    </th>
                    <th>
                        Addons
                    </th>
                    <th>
                        Serve Time
                    </th>
                    <th>
                        Cancel Date
                    </th>
                    <th>
                        Created Date
                    </th>
                    <th>
                        View Product
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "vendor-subscriptions",
    props: ['userId', 'vendorId'],
    data() {
        return {
            subscriptions: [],
            vendor: [],
        };
    },
    mounted() {
        this.showPreloader()
    },
    created() {
        console.log(this.vendorId)
        this.getSubcriptionByVendorId(this.vendorId)
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
        getSubcriptionByVendorId(vendorId) {
            axios.get('/getAllSubByVendorId/' + vendorId).then((rp) => {
                    console.log(rp.data)
                    this.subscriptions = rp.data
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
