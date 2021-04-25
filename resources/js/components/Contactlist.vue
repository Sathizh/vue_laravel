<template>
  <div class="container">
      <h2 class="text-center text-weight-bold m-3 text-success">Contact Details</h2>
      <table class="table">
          <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Designation</th>
                  <th scope="col">Contact Number</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>

          <tbody v-for="(contact,sno) in contacts" :key="contact.id" i='sno'>
              <tr>
                  <td scope="row">{{sno+1}}</td>
                  <td scope="row">{{contact.name}}</td>
                  <td scope="row">{{contact.email}}</td>
                  <td scope="row">{{contact.designation}}</td>
                  <td scope="row">{{contact.contact_no}}</td>
                  <td>
                      <button  class="btn btn-outline-danger" @click.prevent="deleteContact(contact.id)">Delete</button>
                      <router-link :to="{name:'/search_contact',params:{id:contact.id}}" class="btn btn-outline-warning">Edit</router-link>
                      </td>

              </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
export default {
    name:'contact',
    created(){
        this.loadData();

    },
    methods:{
        loadData(){
            let url=this.url+ '/api/getContacts';

            this.axios.get(url).then(response =>{
                this.contacts=response.data
                // console.log(this.contacts);
            });
        },
        deleteContact(id){
            let url=this.url+ `/api/delete_contact/${id}`;
            this.axios.delete(url).then(response =>{
               if(response.status){
                   this.loadData();
                this.$utils.showSuccess('success',response.message);
               }else{
                   this.$utils.showError('Error',response.message);

               }
            });
        }},
        mounted(){
            console.log('contact list component mounted')
        },
        data(){
            return{
                url:document.head.querySelector('meta[name="url"]').content,
                contacts:[],

            }
        }
}
</script>

<style>

</style>
