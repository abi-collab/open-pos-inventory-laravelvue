<template>
  <section class="content">

      <div class="container">
        <br>
        <h1 class="display-4">Customers</h1>
        <div class="row">
          <div class="col-12">
        
            
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Add New Customer</h5>
                    <h5 class="modal-title" v-show="editmode">Edit Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="editmode ? updateCustomer() : createCustomer()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Conatct No.</label>
                            <input v-model="form.contactNo" type="number" name="contactNo"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('contactNo') }">
                            <has-error :form="form" field="contactNo"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input v-model="form.address" type="text" name="address"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                            <has-error :form="form" field="address"></has-error>
                        </div>
                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    

    <br>
  
 
      <b-row>
        <b-col>
          <b-input type="text" v-model="search" placeholder="search"></b-input>
        </b-col>
        <b-col cols="2">
          <b-btn id="addbutton" variant="outline-secondary" @click="newModal">
              <b-icon icon="plus"></b-icon> New Customer
          </b-btn>
        </b-col>
      </b-row>

      <b-row>
        <b-col></b-col>
        <b-col cols="2" style="display:flex">
               <download-excel :data="filteredRows2" class="exports">
                    <b-btn variant="outline-success" size="sm" class="exports"> 
                      <!-- <b-icon icon="file-earmark-excel"></b-icon> -->
                      EXCEL
                    </b-btn>
              </download-excel>
               <download-excel
                  :data="filteredRows2"
                  type="csv"
                  name="filename.xlsx"
                  class="exports"
                >
                  <b-btn size="sm" variant="outline-info" class="exports">
                    <!-- <b-icon icon="file-excel"></b-icon> -->
                    CSV
                  </b-btn>
                </download-excel>
        </b-col>
      </b-row>
     
      <br>
   
    <table class="table">
      <thead>
        <th>Id</th>
        <th>Name</th>
        <th>Contact No.</th>
        <th>Address</th>
        <th>Options</th>
        
      </thead>
      <tbody>
        <tr v-for="sam in filteredRows2" :key="sam.id">
          <td v-html="highlightMatches(sam.id)"></td>
          <td v-html="highlightMatches(sam.name)"></td>
          <td>{{sam.contactNo}}</td>
          <td v-html="highlightMatches(sam.address)"></td>
          <td>
             <span @click="editModal(sam)" class="optionBtn">
                 <b-icon icon="pencil-square"></b-icon>
             </span>
              |
             <span @click="deleteCustomer(sam.id)" class="optionBtn">
                 <b-icon icon="trash"></b-icon>
             </span>
          </td>
        </tr>
      </tbody>
    </table>
    </div>

    <!-- <div class="card-footer">
                  <pagination :data="customers" @pagination-change-page="getResults"></pagination>
          </div> -->
  
  </section>
</template>

<script>
    import VueTagsInput from '@johmun/vue-tags-input';

    export default {
      components: {
          VueTagsInput,
        },
        data () {
            return {
                editmode: false,
                products : {},
                 customers: {
                  data:[],
                  message:''
                 }
                ,
               form: new Form({
                    id:'',
                    name:'',
                    contactNo:'',
                    address:''
                }),
                categories: [],
                tag:  '',
                autocompleteItems: [],
                search:'',
  
               
            }
        },
    
        methods: {

           loadProducts(){

            // if(this.$gate.isAdmin()){
              axios.get("api/customersOrder").then(({ data }) => (this.products.data = data.data.data));
            // }
          },

          getResults(page = 1) {

              this.$Progress.start();
              
              axios.get('api/customers?page=' + page).then(({ data }) => (this.customers = data.data));

              this.$Progress.finish();
          },
          loadCustomers(){

            // if(this.$gate.isAdmin()){
              axios.get("api/customers").then(({ data }) => (this.customers.data = data));
            // }

          },

           loadCustomers2(){

            // if(this.$gate.isAdmin()){
              // axios.get("api/dashboard3").then(({ data }) => (this.customers = data));
            // }

            axios.get("api/customers").then(({ data }) => {
              let cus = []

              for (let i = 0; i < data.length; i++){ // storing every objects original content to it's new declared object property(data)
                data[i].data = {
                  name:data[i].name,
                  id:data[i].id,
                  address:data[i].address,
                  contactNo:data[i].contactNo

                  };

                delete data[i].contactNo;
                delete data[i].address;
                delete data[i].id;
                
                cus.push(data[i]);  
              }

              this.customerx = cus;
              
            });
          },
        
          editModal(customers){
              this.editmode = true;
              this.form.reset();
              $('#addNew').modal('show');
              this.form.fill(customers);
          },
          newModal(){
              this.editmode = false;
              this.form.reset();
              $('#addNew').modal('show');
          },
          createCustomer(){
            
              this.$Progress.start();
               console.log(this.form);

              this.form.post('api/customers')
              .then((data)=>{
                if(data){
                  $('#addNew').modal('hide');
                  console.log(data);

                  Toast.fire({
                        icon: 'success',
                        title: 'Customer Save Successfully!'
                    });

                  this.$Progress.finish();
                  this.loadCustomers();
                  

                } else {
                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again....'
                  });

                  this.$Progress.failed();
                }
              })
              .catch(()=>{

                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });
              })
          },
          updateCustomer(){
              const vm = this;
              this.$Progress.start();
              this.form.put('api/customers/' + vm.form.id)
              .then((response) => {
                  // success
 
                  $('#addNew').modal('hide');
                  Toast.fire({
                    icon: 'success',
                    title: response.data.message
                  });
                  this.$Progress.finish();
                      //  Fire.$emit('AfterCreate');

                  this.loadCustomers();
              })
              .catch(() => {
                  this.$Progress.fail();
              });

          },
          deleteCustomer(id){
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {

                      // Send request to the server
                        if (result.value) {
                              this.form.delete('api/customers/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadCustomers();
                              }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                        }
                  })
          },

          highlightMatches(text) {
            const matchExists = text.toString().includes(this.search);
            if (!matchExists) return text;

            const re = new RegExp(this.search, 'ig');
            return text.toString().replace(re, matchedText => `<strong>${matchedText}</strong>`);
          },
   
        },
  
        created() {

            this.$Progress.start();
            this.loadCustomers();
            this.$Progress.finish();
            this.loadProducts();
        },
        filters: {
            truncate: function (text, length, suffix) {
                return text.substring(0, length) + suffix;
            },

        },
        computed: {
      
           filteredRows2() {
             const vm = this;
            return vm.customers.data.filter(customers => {
              const id = customers.id.toString().toLowerCase();
              const name = customers.name.toLowerCase();
              const contactNo = customers.contactNo.toString().toLowerCase();
              const address = customers.address.toLowerCase();
             
               const search = this.search.toLowerCase();

                  return id.includes(search) || name.includes(search) || contactNo.includes(search) || address.includes(search);
            
            });
          },

        }

    }
</script>
<style scoped>
.content {
  font-family: Arial, Helvetica, sans-serif;
}

#addbutton{
  width:100%;
  /* margin-right:7px; */
}
.optionBtn:hover{
  cursor: pointer;
}
tr:hover{
  background-color: #eee;
  cursor: pointer;
}
.exports{
  width:100%;
}
</style>
