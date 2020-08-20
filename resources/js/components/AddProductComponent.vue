<template>
    <div>
        <div class="container">
            <h1>Add you product</h1>
            <div class="card">
                <div class="card-body">
                    <form class="form-group" @submit.prevent="onSubmit()" id="productForm">
                        <div class="row">
                            <div class="form-group col-6">
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

                            <div class="form-group col-6">
                                <label>rating</label>
                                <input type="number" name="rating" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label>Price</label>
                                <input type="text" name="price" placeholder="Product Price.." class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label>Description</label>
                                <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-6">
                                <label>Type</label>
                                <select name="type" class="form-control">
                                    <option value="none">Select type..</option>
                                    <option value="snack">Snack</option>
                                    <option value="thali">Thali</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Food Type</label>
                                <select name="type" class="form-control">
                                    <option value="none">Select type..</option>
                                    <option value="veg">Veg</option>
                                    <option value="non-veg">Non Veg</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <button class="btn btn-success">Add</button>
                                <button class="btn btn-default" type="reset">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "addProductComponent",
        data() {
            return {
                image: '',
            };
        },
        methods: {
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
                        console.log(res);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
