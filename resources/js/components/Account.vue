<template>
    <div>
        <account-profile v-if="slug==='profile'" :userId="userId"></account-profile>
        <account-order v-if="slug==='order'" :userId="userId"></account-order>
        <account-subscription v-if="slug==='subscription' && singleSubs === 'all'"
                              :userId="userId"></account-subscription>
        <single-subscription v-if="slug==='subscription' && singleSubs!=='all' " :userId="userId"
                             :subId="singleSubs"></single-subscription>
    </div>
</template>

<script>
export default {
    name: "Account",
    props: ['param'],
    data() {
        return {
            slug: null,
            singleSubs: null,
            userId: null,
        };
    },
    mounted() {
        // this.showPreloader()
        console.log(this.param)
        this.slug = this.param['slug']
        this.singleSubs = this.param['subId']
        this.userId = this.param['auth_token']
    },
    created() {
        //
    },
    methods: {}
}
</script>

<style scoped>

</style>
