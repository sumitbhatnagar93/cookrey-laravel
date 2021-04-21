<template>
    <div>
        <div class="container">
            <h2 class="CK-center-title">My All Subscriptions</h2>
            <table class="bg-light shadow-lg table table-bordered">
                <thead>
                <tr>
                    <th>Sub ID</th>
                    <th>Subscribed Product</th>
                    <th>Subscription period</th>
                    <th>Subscribed at</th>
                    <th>View</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="subs of subscriptions">
                    <td>{{ subs.id }}</td>
                    <td>{{subs.product.title}}</td>
                    <td>{{ subs.start_date | formatDate }} to {{ subs.end_date | formatDate }}</td>
                    <td>{{ subs.created_at | formatDate }}</td>
                    <td><a v-bind:href="subs.id" class="btn btn-outline-info">View</a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>Sub ID</th>
                    <th>Subscribed Product</th>
                    <th>Subscription period</th>
                    <th>Subscribed at</th>
                    <th>View</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "account-subscription",
    props: ['userId'],
    data() {
        return {
            subscriptions: [],
        };
    },
    mounted() {
        this.showPreloader()
    },
    created() {
        this.getUserSubscriptions()
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
        getUserSubscriptions() {
            axios.get('/getUserSubscriptionById/' + this.userId).then((rp) => {
                    console.log(rp.data)
                    this.subscriptions = rp.data
                    this.loader.hide()
                },
                (er) => {
                    this.loader.hide()
                    console.log(er)
                })
        },
    }
}
</script>

<style scoped>

</style>
