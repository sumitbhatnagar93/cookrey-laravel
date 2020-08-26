<template>
    <div>
        <div class="ml-2 mr-2">
            <table class="table table-bordered">
                <thead class="bg-info text-light">
                <tr>
                    <th>S.No.</th>
                    <th>Provider ID</th>
                    <th>Business Name</th>
                    <th>Owner Name</th>
                    <th>Owner Email</th>
                    <th>Owner Phone</th>
                    <th>Postal Code</th>
                    <th>Business Type</th>
                    <th>Business Address</th>
                    <th>GSTIN No.</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(vendor,index) of vendors">
                    <td>{{ index + 1 }}</td>
                    <td>{{ vendor.provider_id }}</td>
                    <td>{{ vendor.business_name }}</td>
                    <td>{{ vendor.business_owner_name }}</td>
                    <td>{{ vendor.business_owner_email }}</td>
                    <td>{{ vendor.business_owner_contact }}</td>
                    <td>{{ vendor.postal_code }}</td>
                    <td>{{ vendor.business_type }}</td>
                    <td>{{ vendor.business_address }}</td>
                    <td>{{ vendor.gstin_number }}</td>
                    <td><a v-bind:href="'add-service/'+vendor.provider_id">Edit</a> / <a href="#delete">Delete</a></td>
                </tr>
                </tbody>
                <tfoot class="bg-info text-light">
                <tr>
                    <th>S.No.</th>
                    <th>Provider ID</th>
                    <th>Business Name</th>
                    <th>Owner Name</th>
                    <th>Owner Email</th>
                    <th>Owner Phone</th>
                    <th>Postal Code</th>
                    <th>Business Type</th>
                    <th>Business Address</th>
                    <th>GSTIN No.</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
            <div class="container">
                <a href="/add-service" class="btn btn-primary">Add Vendor</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AllVendors",
    data() {
        return {
            vendors: []
        }
    },
    created() {
        this.onInit();
    },
    methods: {
        onInit() {
            axios('getVendors').then((res) => {
                console.log(res.data)
                this.vendors = res.data
            })
        }
    }
}
</script>

<style scoped>

</style>
