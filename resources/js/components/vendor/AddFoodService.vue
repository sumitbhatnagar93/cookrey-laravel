<template>
    <div>
        <div class="container">
            <h1 v-if="!slug">Add Vendor</h1>
            <h1 v-if="slug">Update Vendor Details</h1>
            <div class="card">
                <div class="card-body">
                    <form class="form-group" @submit.prevent="onSubmit()" id="serviceRegistrationForm">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Tiffin service name </label>
                                <input type="text" required name="business_name" placeholder="Product Title"
                                       v-bind:value="vendor.business_name"
                                       class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Owner name</label>
                                <input type="text" required name="business_owner_name" placeholder="Product Title"
                                       class="form-control" v-bind:value="vendor.business_owner_name">
                            </div>
                            <div class="form-group col-12">
                                <label>Description</label>
                                <textarea name="description" cols="30" rows="10"
                                          class="form-control">{{ vendor.description }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Owner</label>
                                <input type="radio" name="is_business_owner" value="yes"
                                       :checked="vendor.is_business_owner">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Manager</label>
                                <input type="radio" name="is_business_owner" value="no"
                                       :checked="!vendor.is_business_owner">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Owner Contact Number</label>
                                <input type="text" required name="business_owner_contact" minlength="10" maxlength="10"
                                       class="form-control" v-bind:value="vendor.business_owner_contact">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Owner Email</label>
                                <input type="email" required name="business_owner_email" class="form-control"
                                       v-bind:value="vendor.business_owner_email">
                            </div>
                            <div class="form-group col-md-6">
                                <label>City</label>
                                <input type="text" required name="business_city" class="form-control"
                                       v-bind:value="vendor.business_city">
                            </div>
                            <div class="col-md-12">
                                <h4>GSTIN Number?</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Yes</label>
                                <input type="radio" name="is_gstin_number" value="yes"
                                       :checked="vendor.is_gstin_number">
                            </div>
                            <div class="form-group col-md-6">
                                <label>No</label>
                                <input type="radio" name="is_gstin_number" value="no"
                                       :checked="!vendor.is_gstin_number">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Provide GSTIN Number</label>
                                <input type="text" required name="gstin_number" class="form-control"
                                       v-bind:value="vendor.gstin_number">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address</label>
                                <textarea name="business_address" id="business_address" class="form-control"
                                          @change="initMap">{{ vendor.business_address }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Postal Code</label>
                                <input type="text" required name="postal_code" class="form-control"
                                       v-bind:value="vendor.postal_code">
                            </div>
                            <div class="col-md-12">
                                <div id="map" ref="map" style="height: 400px;"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>longitude</label>
                                <input type="text" required name="lat" class="form-control" id="lat"
                                       v-bind:value="vendor.lat">
                            </div>
                            <div class="form-group col-md-6">
                                <label>latitude</label>
                                <input type="text" required name="lng" class="form-control" id="lng"
                                       v-bind:value="vendor.lng">
                            </div>

                            <div class="form-group col-md-6">
                                <label>FSSAI registration name</label>
                                <input type="text" required name="fssai_registered_name" class="form-control"
                                       v-bind:value="vendor.fssai_registered_name">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address on FSSAI</label>
                                <input type="text" required name="fssai_address" class="form-control"
                                       v-bind:value="vendor.fssai_address">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="upload-button">Upload Docs(Aadhar/PAN)
                                    <input type="file" name="adhar_pan" @input="onFileSelectForAdhar">
                                    <input type="hidden" name="old_adhar_pan" v-bind:value="vendor.adhar_pan">
                                </label>
                                <a v-bind:href="'/images/restaurants/'+vendor.provider_id+'/'+vendor.adhar_pan"
                                   target="_blank" v-if="vendor.adhar_pan">
                                    adhar_pan</a>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="upload-button">Upload FSSAI certificate
                                    <input type="file" name="fssai_certificate" @input="onFileSelectForFssai">
                                    <input type="hidden" name="old_fssai_certificate"
                                           v-bind:value="vendor.fssai_certificate">
                                </label>
                                <a v-bind:href="'/images/restaurants/'+vendor.provider_id+'/'+vendor.fssai_certificate"
                                   target="_blank" v-if="vendor.fssai_certificate">
                                    fssai_certificate
                                </a>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Service Type</label>
                                <select name="business_type" class="form-control">
                                    <option value="none">Select type..</option>
                                    <option value="tiffin_service" :selected="vendor.business_type == 'tiffin_service'">
                                        Tiffin Service
                                    </option>
                                    <option value="restaurant" :selected="vendor.business_type == 'restaurant'">
                                        Restaurant
                                    </option>
                                    <option value="bar" :selected="vendor.business_type == 'bar'">Bar</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="upload-button mt-4">Restaurant Front Image
                                    <input type="file" name="business_image" ref="fileInput"
                                           @input="onFileSelect">
                                </label>
                                <input type="hidden" name="old_image" v-bind:value="vendor.business_image">
                            </div>
                            <div class="form-group col-md-12">
                                <img v-bind:src="'/images/restaurants/'+vendor.provider_id+'/'+vendor.business_image"
                                     style="width: 100%;height: 300px;"
                                     v-if="vendor.business_image && !image" @click="selectImage">
                                <div
                                    v-if="image"
                                    class="imagePreviewWrapper"
                                    :style="{ 'background-image': `url(${image})` }"
                                    @click="selectImage">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <input type="hidden" name="provider_id" v-if="vendor.provider_id"
                                       v-bind:value="vendor.provider_id">
                                <button class="btn btn-success">Compete Registration</button>
                                <button class="btn btn-default" type="reset">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <strong class="text-success">{{ this.successMsg }}</strong>
                    <strong class="text-danger">{{ this.errorMsg }}</strong>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddFoodService",
    props: ['slug'],
    data() {
        return {
            successMsg: '',
            errorMsg: '',
            image: '',
            adhar_pan: '',
            fssai_certificate: '',
            lat: '',
            lng: '',
            vendor: ''
        };
    },
    mounted() {
        if (this.slug == undefined) {
            this.initMap('haridwar');
        }
        console.log(this.slug)
        this.getVendorById()
    },
    methods: {
        getVendorById() {
            axios('/getVendorById/' + this.slug).then((res) => {
                this.vendor = res.data[0]
                this.initMap(this.vendor.business_address);
                console.log(res.data)
            })
        },
        initMap: function (address) {
            var address2 = document.getElementById('business_address').value;
            if (address2) {
                address = address2
            }
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({address: address}, (results, status) => {

                document.getElementById('lat').value = results[0].geometry.location.lat();
                document.getElementById('lng').value = results[0].geometry.location.lng();
                // console.log(results);
                var mapOptions =
                    {
                        zoom: 16,
                        center: {
                            lat: results[0].geometry.location.lat(),
                            lng: results[0].geometry.location.lng()
                        }
                    };

                var map = new google.maps.Map(document.getElementById('map'), mapOptions);
                var marker = new google.maps.Marker({
                    position: {
                        lat: results[0].geometry.location.lat(),
                        lng: results[0].geometry.location.lng()
                    },
                    map,
                    title: "Drag me!",
                    draggable: true
                });
                google.maps.event.addListener(marker, 'dragend', function (event) {
                    console.log(event.latLng.lat(), event.latLng.lng())
                    document.getElementById('lat').value = event.latLng.lat();
                    document.getElementById('lng').value = event.latLng.lng();
                    localStorage.setItem('latlng', JSON.stringify({lat: event.latLng.lat(), lng: event.latLng.lng}));
                    geocoder.geocode({
                        location: {
                            lat: parseFloat(event.latLng.lat()),
                            lng: parseFloat(event.latLng.lng())
                        }
                    }, (results, status) => {
                        console.log(results);
                        document.getElementById('business_address').value = results[0].formatted_address;
                    })
                });
            });

        },
        selectImage() {
            this.$refs.fileInput.click()
        },
        onFileSelectForAdhar(e) {
            const adharCard = e.target.files || e.dataTransfer.files;
            if (!adharCard.length)
                return;
            const reader1 = new FileReader();
            reader1.onload = (e) => {
                this.adhar_pan = e.target.result;
            };
            reader1.readAsDataURL(adharCard[0]);
            console.log(this.adhar_pan);
        },
        onFileSelectForFssai(e) {
            const fssai_certificate = e.target.files || e.dataTransfer.files;
            if (!fssai_certificate.length)
                return;
            const reader2 = new FileReader();
            reader2.onload = (e) => {
                this.fssai_certificate = e.target.result;
            };
            reader2.readAsDataURL(fssai_certificate[0]);
        },
        onFileSelect(e) {
            const input = this.$refs.fileInput
            const file = input.files
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
            let url = '';
            if (this.vendor) {
                url = '/update-service';
            } else {
                url = '/add-business';
            }
            let formData = new FormData(document.getElementById('serviceRegistrationForm'));
            formData.append('business_image', this.image);
            formData.append('adhar_pan', this.adhar_pan);
            formData.append('fssai_certificate', this.fssai_certificate);
            axios.post(url, formData)
                .then(res => {
                    console.log(res);
                    this.errorMsg = '';
                    this.successMsg = 'Business added successfully';
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
