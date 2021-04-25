<template>
<div>
    <div class="container">
        <h2 class="text-center p-2 text-white bg-primary mt-5">
            Add New Contact</h2>
            <div class="card-body">
                <div class="col-md-6 offset-md-3">
                    <form id="validateForm" @submit.prevent="saveContact" method="post" novalidate enctype="multipart/form-data">
                        <div class="alert alert-danger" v-if="errors.length">
                            <ul class="mb-0">
                                <li v-for="(error,index) in errors" :key="index">
                                    {{ error }}
                                </li>
                            </ul>
                            </div>
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" name="name" id="name" v-model="contact.name" class="form-control" placeholder="Enter Name" >
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" name="email" id="email" v-model="contact.email" class="form-control" placeholder="sample@gmail.com" >
                        </div>
                        <div class="form-group">
                          <label for="designation">designation</label>
                          <input type="text" name="designation" id="designation" v-model="contact.designation" class="form-control" placeholder="Entern designation" >
                        </div>
                        <div class="form-group">
                          <label for="contact_no">Contact Number</label>
                          <input type="tel" pattern="[0-9]{10}" name="contact_no" id="contact_no" v-model="contact.contact_no" class="form-control" placeholder="Entern Contact Number" >
                        </div>
                        <div class="form-group">
                          <label for="bio">Biography</label>
                          <textarea name="bio" id="bio" cols="20" rows="5" class="form-control" v-model="contact.bio" placeholder="Entern Biography"></textarea>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="image" class="form-control" id="validateCustimFile" v-on:change="saveImage">
                        </div>
                        <input type="submit" value="Submit" class="btn btn-primary mt-4">
                    </form>
                </div>
            </div>

    </div>
</div>
</template>

<script>
export default {
    data(){
        return {
            url:document.head.querySelector('meta[name="url"]').content,
            contact:[],
            name:'',
            email:'',
            bio:'',
            designation:'',
            contact_no:'',
            errors:[],
        }
    },
    methods:{
        saveContact(){
            this.errors=[];
            if(!this.contact.name)
            {
                this.errors.push('Name is required');
            }
            if(!this.contact.email)
            {
                this.errors.push('Email is required');
            }
            if(!this.contact.designation)
            {
                this.errors.push('Designation is required');
            }
            if(!this.contact.contact_no)
            {
                this.errors.push('Contact Number is required');
            }
            if(!this.errors.length){
                let formData = new FormData();
                formData.append('name',this.contact.name);
                formData.append('email',this.contact.email);
                formData.append('image',this.image);
                formData.append('bio',this.contact.bio);
                formData.append('designation',this.contact.designation);
                formData.append('contact_no',this.contact.contact_no);

                let url=this.url+ '/api/save_contact';

                this.axios.post(url,formData).then(response =>{
                    if(response.status){
                        document.getElementById('name').value="";
                        document.getElementById('email').value="";
                        document.getElementById('designation').value="";
                        document.getElementById('bio').value="";
                        document.getElementById('contact_no').value="";
                        this.$utils.showSuccess('success',response.message);
                    }else{

                        this.$utils.showError('Error',response.message);
                    }
                }).catch(error => {
                    this.errors.push(error.response.data.error);
                });
            }
        },
        saveImage(e){
            this.image=e.target.files[0];
            console.log(this.image);
        },
    },
    mounted: function(){
        console.log("add contacts Component loaded")
    }
}
</script>

<style>

</style>
