<template>
    <div class="content pure-u-1 pure-u-md-21-24">
        <div class="header-small">

            <div class="items">
                <h1 class="subhead">Post Form</h1>

                <!--<aside class="pure-message message-success">
                    <p><strong>SUCCESS</strong>: Success message.</p>
                </aside>
                <aside class="pure-message message-error">
                    <p><strong>ERROR</strong>: Error message.</p>
                </aside>
                <aside class="pure-message message-warning">
                    <p><strong>WARNING</strong>: Warning message.</p>
                </aside>-->
                <form  novalidate autocomplete="off" class="pure-form pure-form-stacked">
                    <fieldset>
                        <label for="title">Name</label>
                        <input id="title" type="text" placeholder="Title" class="pure-input-1" v-model="insertData.name">

                        <!--<label for="slug">Slug</label>
                        <input id="slug" type="text" placeholder="Slug" class="pure-input-1" value="" disabled>-->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="excerpt">Image</label>
                                <input id="excerpt" type="file" @change="OnFileChange" placeholder="Photo" class="pure-input-1" >
                                <img :src ="previewImage" class="uploading-image img-thumbnail" style="width:150px;height:100px"/>
                            
                        
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" :style="'width:'+percent+'%'" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <!-- <h4>upload : {{percent}}</h4> -->
                            </div>
                            <div class="col-md-6">
                                <label for="status">Category</label>
                                <select id="status" class="pure-input-1" v-model="insertData.category">
                                    <option value="">--select one--</option>
                                    <option value="1">Category - 1</option>
                                    <option value="2">Category - 2</option>
                                    <option value="3">Category - 3</option>
                                    <option value="4">Category - 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="total_amount">Quantity</label>
                                <input id="total_amount" type="number" placeholder="quantity" class="pure-input-1" v-model="insertData.quantity">
                            </div>
                            <div class="col-md-6">
                                <label for="paid_amount">Price</label>
                                <input  id="paid_amount" type="number" placeholder="quantity" class="pure-input-1" v-model="insertData.price">
                            </div>
                        </div>
                        <label for="content">Description</label>
                        <textarea id="content" class="pure-input-1" rows="4" v-model="insertData.description"></textarea>

                        <input type="hidden" name="id" value="1">
                        <a href="javaScript:void(0)" class="pure-button button-success" @click="OnSubmit()">Save</a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
 import axios from 'axios'; 
    export default {
        name: 'ProductCreate',

        props: {
            msg: String
        },
        data(){
            return{
                insertData:{
                    name:'',
                    quantity:'',
                    price:'',
                    description:'',
                    category:'',
                },
                previewImage:null,
                selectedFile :null,
                percent:0,
            }
        },
        mounted(){
            console.log(this.name)
        },
        methods:{
            OnFileChange(event){
                let obj = this;
                obj.selectedFile = event.target.files[0];
                

                const image = event.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.previewImage = e.target.result;
//                    console.log(this.previewImage);
                };
            },
            OnSubmit(){
                 let obj = this;
                let formData = new FormData();
                formData.append('name' ,obj.insertData.name);
                formData.append('quantity' ,obj.insertData.quantity);
                formData.append('price' ,obj.insertData.price);
                formData.append('category' ,obj.insertData.category);
                formData.append('description' ,obj.insertData.description);
                formData.append('image' ,obj.selectedFile, obj.selectedFile.name);
                axios.post("http://127.0.0.1:8000/api/v1/product/store", formData
                ,{onUploadProgress : uploadEvent=>{
                        let a = Math.round(uploadEvent.loaded / uploadEvent.total * 100);
                        obj.percent = a;
                    }
                }
                )
                .then(function (response) {
                    console.log(response);
                    if(response.data.error){
                        obj.$iziToast.error({
                        title: 'Error',
                        message: response.data.message,
                    });
                }
                    else{
                        // obj.reInitialize();
                        obj.$iziToast.success({
                        title: 'Success',
                        message: response.data.message,
                        });
                        obj.insertData.name = '';
                        obj.insertData.quantity = '';
                        obj.insertData.price = '';
                        obj.insertData.description = '';
                        obj.previewImage = null;
                        obj.percent = 0;
//                        obj.$router.push({path: "products"});
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }


    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

