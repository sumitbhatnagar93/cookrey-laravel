<template>
    <div>
        <div class="container">
            <h1>Add subscription product</h1>
            <div class="card">
                <div class="card-body">
                    <form class="form-group" @submit.prevent="onSubmit()" id="productForm">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Title</label>
                                <input type="text" name="title" placeholder="Product Title" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Select Vendor</label>
                                <select name="vendor_id" class="form-control">
                                    <option value="none">Select type..</option>
                                    <option v-for="(vendor,index) of vendors" v-bind:value="vendor.provider_id">
                                        {{ vendor.business_name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Food Type</label>
                                <select name="veg_non_veg" class="form-control">
                                    <option value="none">Select type..</option>
                                    <option value="veg">Veg</option>
                                    <option value="non-veg">Non Veg</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" >
                                <label>Price per meal</label>
                                <input type="text" name="price"
                                       placeholder="Product Price.." class="form-control">
                            </div>
                            <div class="col-12 form-group" >
                                <label>Add Tiffin Items</label>
                                <div class="container">
                                    <div class="row" v-for="(v,i) in productItem">
                                        <div class="col-md-6 form-group">
                                            <input type="text" class="form-control" placeholder="item name"
                                                   name="in_the_box[]">
                                        </div>
                                        <div class="col-md-6 form-group">
                                                <span>
                                            <i class="bg-danger fa fa-minus fas p-2 rounded-circle text-white"
                                               @click="removeItem(i)"
                                               v-show="i || ( !i && productItem.length > 1)">
                                            </i>
                                            <i class="bg-info fa fa-plus fas p-2 rounded-circle text-white"
                                               @click="addItem()"
                                               v-show="i === productItem.length-1">
                                            </i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <button class="btn btn-success">Add Product</button>
                                <button class="btn btn-default" type="reset">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <strong class="text-success">{{ this.successMsg }}</strong>
                    <strong class="text-danger">{{ this.errorMsg }}</strong>
                </div>
            </div>
        </div>
        <hr>
    </div>
</template>

<script>
export default {
    name: "vendor-single-product",
    data() {
        return {
            productType: 'simple',
            successMsg: '',
            errorMsg: '',
            vendors: [],
            productItem: [{}],
        };
    },
    created() {
        this.getVendors();
    },
    methods: {
        addItem: function () {
            this.productItem.push({});
        },
        removeItem(index) {
            this.productItem.splice(index, 1);
        },
        getVendors() {
            axios.get('getVendors')
                .then(res => {
                    this.vendors = res.data;
                    console.log(res.data);
                })
        },
        onSubmit() {
            let formData = new FormData(document.getElementById('productForm'));
            axios.post('upload-tiffin', formData)
                .then(res => {
                    console.log(res.data);
                    this.errorMsg = '';
                    this.successMsg = 'product added successfully';
                }).catch(er => {
                this.successMsg = '';
                this.errorMsg = 'something went wrong.. ask sumit to solve this';
            })
        }
    }
}
</script>

<style scoped>

</style>
