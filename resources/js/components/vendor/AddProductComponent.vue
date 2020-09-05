<template>
    <div>
        <div class="container">
            <h1>Add you product</h1>
            <div class="card">
                <div class="card-body">
                    <form class="form-group" @submit.prevent="onSubmit()" id="productForm">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Title</label>
                                <input type="text" name="title" placeholder="Product Title" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label>Iamge</label>
                                <input type="file" name="image" class="form-control" ref="fileInput"
                                       @input="onFileSelect">
                                <div
                                    v-if="image"
                                    class="imagePreviewWrapper"
                                    :style="{ 'background-image': `url(${image})` }"
                                    @click="selectImage">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>rating</label>
                                <input type="number" name="rating" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Price</label>
                                <input type="text" name="price" placeholder="Product Price.." class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label>Description</label>
                                <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Type</label>
                                <select name="type" class="form-control">
                                    <option value="none">Select type..</option>
                                    <option value="snack">Snack</option>
                                    <option value="thali">Thali</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Select Vendor</label>
                                <select name="provider_id" class="form-control">
                                    <option value="none">Select type..</option>
                                    <option v-for="(vendor,index) of vendors" v-bind:value="vendor.provider_id">
                                        {{ vendor.business_name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Food Type</label>
                                <select name="food_type" class="form-control">
                                    <option value="none">Select type..</option>
                                    <option value="veg">Veg</option>
                                    <option value="non-veg">Non Veg</option>
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                <label>Select Product Type</label>
                                <select name="product_type" class="form-control">
                                    <option value="simple">Simple</option>
                                    <option value="variable">Variable</option>
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                <label for="add-ons">Add-ons?</label>
                                <input type="checkbox" name="haveAddOns" id="add-ons" value="yes" @click="haveAddons">
                            </div>
                            <div class="container" v-if="haveAddon">
                                <section class="border m-2 p-3" v-for="(bok,i) in feilds">
                                    <h3>Add-ons {{ i + 1 }}</h3>
                                    <div class="form-group">
                                        <label>Add-ons Title</label>
                                        <input type="text" class="form-control" name="addOnTitle[]">
                                    </div>
                                    <div class="add-on-area" ref="add-on">
                                        <div class="row" v-for="(child,k) in bok.subfeilds" :key="k">
                                            <div class="col-4 form-group">
                                                <input type="text" class="form-control" name="addon[]">
                                            </div>
                                            <div class="col-4 form-group">
                                                <input type="text" class="form-control" name="addonPrice[]">
                                            </div>
                                            <div class="col-4">
                                                <span>
                                            <i class="bg-danger fa fa-minus fas p-2 rounded-circle text-white"
                                               @click="remove(bok,k)"
                                               v-show="k || ( !k && bok.subfeilds.length > 1)">
                                            </i>
                                            <i class="bg-info fa fa-plus fas p-2 rounded-circle text-white"
                                               @click="addChild(bok)"
                                               v-show="k === bok.subfeilds.length-1">
                                            </i>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="col-12 form-group">
                                    <a class="btn btn-primary text-light" @click="addNewRules">Add More
                                        Section</a>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <button class="btn btn-success">Add Product</button>
                                <button class="btn btn-default" type="reset">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
    </div>
</template>

<script>
export default {
    name: "addProductComponent",
    data() {
        return {
            image: '',
            vendors: [],
            haveAddon: false,
            feilds: [{
                name: null,
                sections: [],
                subfeilds: [{name: null}],
            }],
        };
    },
    created() {
        this.getVendors();
    },
    methods: {
        haveAddons() {
            this.haveAddon = !this.haveAddon;
            console.log(this.haveAddon)
        },
        addNewRules: function () {
            this.feilds.push({
                name: null,
                sections: [],
                subfeilds: [{name: null}],
            });
        },
        addChild: function (bok) {
            bok.subfeilds.push({});
        },
        remove(bok, index) {
            bok.subfeilds.splice(index, 1);
        },
        addMoreAddonSection() {
            this.addonSection.push(this.addonSection.length + 1);
            console.log(this.addonSection);
        },
        getVendors() {
            axios.get('getVendors')
                .then(res => {
                    this.vendors = res.data;
                    console.log(res.data);
                })
        },
        selectImage() {
            this.$refs.fileInput.click()
        },
        onFileSelect(e) {
            let input = this.$refs.fileInput
            let file = input.files
            if (file && file[0]) {
                let reader = new FileReader
                reader.onload = e => {
                    this.image = e.target.result
                }
                reader.readAsDataURL(file[0])
                this.$emit('input', file[0])
            }
            console.log(this.image);
        },
        onSubmit() {
            let formData = new FormData(document.getElementById('productForm'));
            formData.append('image', this.image);
            axios.post('upload-product', formData)
                .then(res => {
                    console.log(res.data);
                })
        }
    }
}
</script>

<style scoped>

</style>
