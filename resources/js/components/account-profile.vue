<template>
    <div>
        <div class="container CK-user-account">
            <h2 class="text-center CK-center-title">My Account</h2>
            <div class="row">
                <div class="card profile-card">
                    <form class="form-group container" @submit.prevent="onSubmit()" id="userUpdateForm">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="fname">First Name</label>
                                <input type="text" id="fname" name="firstName" v-model="user.users_meta.firstName" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lname">Last Name</label>
                                <input type="text" id="lname" name="lastName" v-model="user.users_meta.lastName" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="text" name="email" v-model="user.email" id="email" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" v-model="user.phone" id="phone" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address"
                                          v-model="user.users_meta.address"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info" type="submit">Update Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from "vue";

export default {
    name: "account-profile",
    props: ['userId'],
    data() {
        return {
            user: {
                name: null,
                email: null,
                phone: null,
                users_meta: {firstName: '', lastName: '',address: ''}
            },
            userAddress: 'jdbsfhdbsf',
        };
    },
    mounted() {
         this.showPreloader()
        console.log('user id is - ', this.userId)
    },
    created() {
        this.getUserInfo()
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
        getUserInfo() {
            axios.get('/user/' + this.userId).then((rp) => {
                    console.log(rp.data)
                    this.user = rp.data
                    this.loader.hide()
                },
                (er) => {
                    console.log(er)
                })
        },
        onSubmit() {
            this.showPreloader()
            axios.post('/api/oauth/updateUser', this.user).then((res) => {
                console.log(res)
                this.loader.hide()
                let instance = Vue.$toast.open({
                    message: res.data.message,
                    type: res.data.responseType,
                });
            }, (er) => {
                console.log(er)
            })
        }
    }
}
</script>

<style scoped>

</style>
