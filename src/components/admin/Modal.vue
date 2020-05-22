<template>
        <div class="jumbotron jumbotron-fluid" style="position: absolute; width: 80%;margin-top: 2%; background-color: #d5c086">
            <div class="container" v-if="!preLoader">
                <h5 style="margin-top: -4%">Product edit</h5>
                    <form>
                        <div class="form-group">
                            <label for="formGroupExampleInput1">Name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput1" placeholder="Example input" v-model="fromData.name">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Image</label>
                                    <input type="file" class="form-control" id="formGroupExampleInput2" placeholder="Another input" @change="OnFileChange" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{imageStatus}}</label>
                                    <img :src="image" class="form-control" style="width: 30%">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput4">Category</label>
                                    <select id="formGroupExampleInput4" class="form-control" v-model="fromData.category" >
                                        <option value="">--select one--</option>
                                        <option value="1">Category - 1</option>
                                        <option value="2">Category - 2</option>
                                        <option value="3">Category - 3</option>
                                        <option value="4">Category - 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput5">Quantity</label>
                                    <input type="number" class="form-control" id="formGroupExampleInput5" placeholder="Another input" v-model="fromData.quantity">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput6">Price</label>
                                    <input type="number" class="form-control" id="formGroupExampleInput6" placeholder="Another input" v-model="fromData.price">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput6">Description</label>
                            <textarea  class="form-control"  placeholder="Another input" rows="4" v-model="fromData.description">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-sm" @click.prevent="EditSubmit(fromData.id)">Update</button>
                            <button class="btn btn-danger btn-sm" @click.prevent="$emit('closeModal')">Cancel</button>
                        </div>
                    </form>
            </div>
            <div class="container" v-else style="height: 350px">
                <img src="/assets/loading/loading-5.gif" style="width: 5%; margin-left: 45%;margin-top: 12%">
            </div>
        </div>
       
</template>

<script>
    import axios from 'axios';
    export default {

        name: 'Modal',

        data(){
            return{
                path :'http://127.0.0.1:8000/product/images/',
                preLoader: false,
                fromData:[],
                imageStatus : 'Old Image',
                selectedFile :null,
                previewImage:null,
                image:null,
                confirmation: false,
                percent : 0
            }
        },
        props: {
            msg: String,
            productId : Number
        },
        mounted(){

//            let obj = this;
            this.setEditData()
        },
        methods:{

            setEditData(){
                let obj = this;
                obj.preLoader = true;
                let data = obj.productId;
//                let id = this.data;
                obj.loading =  true;
                axios.get("http://127.0.0.1:8000/api/v1/product/edit"+"/"+data)
                    .then(function (response) {
                        obj.fromData = response.data.product;
                        obj.image = obj.path + response.data.product.image;
                        console.log(response);
                        obj.preLoader = false;})
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
            },
            OnFileChange(event){
                let obj = this;
                obj.selectedFile = event.target.files[0];
                

                const image = event.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    obj.image = e.target.result;
                    obj.confirmation = true;

                    obj.imageStatus = 'New Image';
//                    console.log(this.previewImage);
                };
            },
           EditSubmit(ID){

                 let obj = this;
                let fd = new FormData();
                console.log(obj.fromData.name);
                fd.append('name' ,obj.fromData.name);
                fd.append('quantity' ,obj.fromData.quantity);
                fd.append('price' ,obj.fromData.price);
                fd.append('category' ,obj.fromData.category);
                fd.append('description' ,obj.fromData.description);
                if(obj.confirmation ){
                    console.log('dukhtese');
                     fd.append('image' ,obj.selectedFile, obj.selectedFile.name);
                }
                
                axios.post("http://127.0.0.1:8000/api/v1/product/update"+"/"+ID ,fd
                // ,{onUploadProgress : uploadEvent=>{
                //         let a = Math.round(uploadEvent.loaded / uploadEvent.total * 100);
                //         obj.percent = a;
                //     }
                // }
                )
                .then(function (response) {
                    if(response.data.error){
                        obj.$iziToast.error({
                            title: 'Error',
                            message: response.data.message,
                        });
                    }else{
                        obj.$iziToast.success({
                            title: 'success',
                            message: response.data.message,
                        });
                        console.log(response);
                        obj.$emit('refresh');
                    }
                    
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            }

        },

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

