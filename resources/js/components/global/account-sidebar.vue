<template>
    <div>
        <div class="container CK-acc-menu">
            <div class="card">
                <nav class="navbar navbar-expand-lg navbar-light bg-dark">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav flex-column">
                            <li :class="(item.slug === slug)?'nav-item active':'nav-item'" v-for="item of menu">
                                <a class="nav-link"
                                   v-bind:href="item.url">{{ item.name }}</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "account-sidebar",
    props: ['menu', 'slug'],
    data() {
        return {};
    },
    mounted() {
        // this.showPreloader()
        console.log(this.menu)
    },
    created() {
        //
    },
    methods: {}
}
</script>

<style scoped>

</style>
