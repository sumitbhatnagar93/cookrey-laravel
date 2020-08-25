<template>
    <div>
        <div class="container">
            <h1>Add you restaurant or tfiifin service</h1>
            <div class="card">
                <div class="card-body">
                    <form class="form-group" @submit.prevent="onSubmit()" id="serviceRegistrationForm">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Tiffin service name</label>
                                <input type="text" required name="business_name" placeholder="Product Title"
                                       class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Owner name</label>
                                <input type="text" required name="business_owner_name" placeholder="Product Title"
                                       class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label>Description</label>
                                <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Owner</label>
                                <input type="radio" name="is_business_owner" value="yes">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Manager</label>
                                <input type="radio" name="is_business_owner" value="no">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Owner Contact Number</label>
                                <input type="text" required name="business_owner_contact" minlength="10" maxlength="10"
                                       class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Owner Email</label>
                                <input type="email" required name="business_owner_email" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>City</label>
                                <input type="text" required name="business_city" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <h4>GSTIN Number?</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Yes</label>
                                <input type="radio" name="is_gstin_number" value="yes">
                            </div>
                            <div class="form-group col-md-6">
                                <label>No</label>
                                <input type="radio" name="is_gstin_number" value="no">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Provide GSTIN Number</label>
                                <input type="text" required name="gstin_number" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address</label>
                                <textarea name="business_address" id="business_address" class="form-control"
                                          @change="initMap"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Postal Code</label>
                                <input type="text" required name="postal_code" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <div id="map" ref="map" style="height: 400px;"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>longitude</label>
                                <input type="text" required name="lat" class="form-control" id="lat">
                            </div>
                            <div class="form-group col-md-6">
                                <label>latitude</label>
                                <input type="text" required name="lng" class="form-control" id="lng">
                            </div>

                            <div class="form-group col-md-6">
                                <label>FSSAI registration name</label>
                                <input type="text" required name="fssai_registered_name" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address on FSSAI</label>
                                <input type="text" required name="fssai_address" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="upload-button">Upload Docs(Aadhar/PAN)
                                    <input type="file" name="adhar_pan" @input="onFileSelectForAdhar">
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="upload-button">Upload FSSAI certificate
                                    <input type="file" name="fssai_certificate" @input="onFileSelectForFssai">
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Service Type</label>
                                <select name="business_type" class="form-control">
                                    <option value="none">Select type..</option>
                                    <option value="tiffin_service">Tiffin Service</option>
                                    <option value="restaurant">Restaurant</option>
                                    <option value="bar">Bar</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="upload-button mt-4">Restaurant Front Image
                                    <input type="file" name="business_image" ref="fileInput"
                                           @input="onFileSelect">
                                </label>
                                <div
                                    v-if="image"
                                    class="imagePreviewWrapper"
                                    :style="{ 'background-image': `url(${image})` }"
                                    @click="selectImage">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Latitute</label>
                                <input type="text" required name="business_map_lat" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Longitute</label>
                                <input type="text" required name="business_map_lng" class="form-control">
                            </div>
                            <div class="form-group col-12">
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
    data() {
        return {
            successMsg: '',
            errorMsg: '',
            image: '',
            adhar_pan: '',
            fssai_certificate: '',
            lat: '',
            lng: ''
        };
    },
    mounted() {
        this.initMap();
    },
    methods: {
        initMap: function () {
            var address = document.getElementById('business_address').value;
            console.log(address)
            if (address === '') {
                address = 'bahadrabad';
            }
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({address: address}, (results, status) => {
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
                    // marker.infoWindow.open(map, marker);
                    //this.getAddressByCoords(event.latLng.lat(), event.latLng.lng());
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
        getAddressByCoords(lat, lng) {
            var latlng = {lat: lat, lng: lng};
            geocoder.geocode({location: latlng}, (results, status) => {
                console.log(results);
            })

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
            let formData = new FormData(document.getElementById('serviceRegistrationForm'));
            formData.append('business_image', this.image);
            formData.append('adhar_pan', this.adhar_pan);
            formData.append('fssai_certificate', this.fssai_certificate);
            axios.post('add-business', formData)
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
