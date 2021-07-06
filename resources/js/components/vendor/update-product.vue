<template>
    <div>
        <div class="container">
            <h1>Update product</h1>
            <div class="card">
                <div class="card-body">
                    <form class="form-group" @submit.prevent="onSubmit()" id="productForm">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Title</label>
                                <input type="text" v-model="product.title" name="title" placeholder="Product Title"
                                       class="form-control">
                            </div>
                            <input type="hidden" name="vendor_id" v-model="param.vendorID">
                            <div class="form-group col-md-6">
                                <label>Food Type</label>
                                <select name="veg_non_veg" v-model="product.veg_non_veg" class="form-control">
                                    <option value="none">Select type..</option>
                                    <option value="veg">Veg</option>
                                    <option value="non-veg">Non Veg</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Price per meal</label>
                                <input type="text" name="price" v-model="product.price"
                                       placeholder="Product Price.." class="form-control">
                            </div>
                            <div class="col-12 form-group">
                                <label>Add Tiffin Items</label>
                                <div class="container">
                                    <div class="row" v-for="(val,i) in productItem">
                                        <div class="col-md-6 form-group">
                                            <input type="text" class="form-control" v-if="productItem[i].length"
                                                   v-model="productItem[i]" placeholder="item name"
                                                   name="in_the_box[]">
                                            <input type="text" class="form-control" v-if="!productItem[i].length"
                                                   placeholder="item name"
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
                                <button class="btn btn-success">Update Product</button>
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
    name: "update-product",
    props: ['param'],
    data() {
        return {
            product: [],
            successMsg: '',
            errorMsg: '',
            productItem: [{}],
        };
    },
    mounted() {
        console.log('okkks', this.param)
    },
    created() {
        this.getProductInfoById();
    },
    methods: {
        addItem: function () {
            this.productItem.push({});
            console.log(this.productItem)
        },
        removeItem(index) {
            this.productItem.splice(index, 1);
        },
        getProductInfoById() {
            axios.get('../getSingleProductById/' + this.param.productID)
                .then(res => {
                    this.product = res.data[0];
                    this.productItem = JSON.parse(this.product.in_the_box)
                    console.log(res.data);
                    console.log(this.productItem);
                })
        },
        onSubmit() {
            let formData = new FormData(document.getElementById('productForm'));
            formData.append('id', this.param.productID)
            axios.post('../update-product-info', formData)
                .then(res => {
                    console.log(res.data);
                    this.errorMsg = '';
                    this.successMsg = 'product updated successfully';
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
