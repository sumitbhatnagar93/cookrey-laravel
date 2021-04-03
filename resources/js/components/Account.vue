<template>
    <div>
        <div class="container CK-user-account mt-3">
            <h2 class="text-center CK-center-title">My Account</h2>
            <div class="row">
                <div class="card profile-card">
                    <form class="form-group container">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="address">Address</label><br>
                                <textarea name="address" id="address" cols="30" rows="5"></textarea>
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
export default {
    name: "Account"
}
</script>

<style scoped>

</style>
