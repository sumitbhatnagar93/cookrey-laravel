<template>
    <div>
        <div class="container">
            <h2>Subscription #1</h2>
            <div class="card">
                <table>
                    <tr>
                        <th>Plan Name:</th>
                        <td>{{ subscription.product.title }}</td>
                    </tr>
                    <tr>
                        <th>Plan Validity:</th>
                        <td>1 {{ subscription.validity }} ({{ subscription.start_date }} -
                            {{ subscription.end_date }})
                        </td>
                    </tr>
                    <tr>
                        <th>Serve Time:</th>
                        <td>{{ subscription.serve_time }}</td>
                    </tr>
                    <tr>
                        <th>Addons:</th>
                        <td>{{ subscription.addon }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "single-subscription",
    props: ['param'], data() {
        return {
            subscription: [],
            vendor: [],
        };
    },
    mounted() {
        this.loader.hide()
        console.log(this.param.subInfo)
    },
    created() {
        this.subscription = this.param.subInfo[0]
        this.showPreloader()
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

    }
}
</script>

<style scoped>

</style>
