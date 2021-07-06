<template>
    <div>
        <vendor-profile v-if="slug==='profile'" :userId="userId"></vendor-profile>
        <vendor-orders v-if="slug==='orders' && vendorId!=null" :userId="userId" :vendorId="vendorId"></vendor-orders>
        <vendor-products v-if="slug==='products' && unique=== 'all' && vendorId!=null"
                         :userId="userId" :vendorId="vendorId"></vendor-products>
        <vendor-single-product v-if="slug==='products' && unique!== 'all'"
                               :userId="userId"></vendor-single-product>
        <vendor-subscriptions v-if="slug==='subscriptions' && vendorId!=null"
                              :userId="userId" :vendorId="vendorId"></vendor-subscriptions>
    </div>
</template>

<script>
export default {
    name: "Vendor",
    props: ['param'],
    data() {
        return {
            vendorId: null,
            slug: null,
            unique: null,
            userId: null,
        };
    },
    mounted() {
        // this.showPreloader()
        console.log(this.param)
        this.slug = this.param['slug']
        this.unique = this.param['unique']
        this.userId = this.param['auth_token']
        this.getVendorByUserId(this.param['auth_token'])
    },
    created() {
    },
    methods: {
        getVendorByUserId(userId) {
            axios('/vendor/getVendorById/' + userId).then((res) => {
                this.vendorId = res.data[0].provider_id
            })
        }
    }
}
</script>

<style scoped>

</style>
