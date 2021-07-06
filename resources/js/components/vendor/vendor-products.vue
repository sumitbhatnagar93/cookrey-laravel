<template>
    <div>
        <div class="container">
            <h2 class="CK-center-title">All Products</h2>
            <table class="bg-light shadow-lg table table-bordered">
                <thead>
                <tr>
                    <th>
                        Product ID
                    </th>
                    <th>
                        Product Title
                    </th>
                    <th>
                        Created Date
                    </th>
                    <th>
                        View/Update
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="product of products">
                    <td>
                        #{{ product.id }}
                    </td>
                    <td>
                        {{ product.title }}
                    </td>
                    <td>
                        {{ product.created_at | formatDate }}
                    </td>
                    <td>
                        <a v-bind:href="/update-product/+product.id" class="btn btn-outline-info">View/Update</a>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>
                        Product ID
                    </th>
                    <th>
                        Product Title
                    </th>
                    <th>
                        Created Date
                    </th>
                    <th>
                        View/Update
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "vendor-products",
    props: ['userId', 'vendorId'],
    data() {
        return {
            products: [],
            vendor: [],
        };
    },
    mounted() {
        console.log(this.vendorId)
        this.showPreloader()
        this.getProductsByVendorId(this.vendorId)
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
        getProductsByVendorId(vendorId) {
            axios.get('/getProductByVendorId/' + vendorId).then((rp) => {
                    console.log(rp.data)
                    this.products = rp.data
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
