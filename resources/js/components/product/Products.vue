<template>
  <section class="content">
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true" >
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Add New Laptop</h5>
                    <h5 class="modal-title" v-show="editmode">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="editmode ? updateProduct() : createProduct()">
                    <div class="modal-body">
                      <!-- <b-form-group
                        label="SKU"
                        label-for="sku"
                        label-cols-sm="3"
                        label-align-sm="right"
                      >
                        <b-form-input id="sku" v-model="form.sku" type="text" name="sku"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('sku') }"></b-form-input>
                                 <has-error :form="form" field="sku"></has-error>
                      </b-form-group> -->

                       <b-form-group
                        label="Name"
                        label-for="name"
                        label-cols-sm="3"
                        label-align-sm="right"
                      >
                        <b-form-input id="name" v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"></b-form-input>
                                <has-error :form="form" field="name"></has-error>
                      </b-form-group>

                      <b-form-group
                        label="Description"
                        label-for="description"
                        label-cols-sm="3"
                        label-align-sm="right"
                      >
                        <b-form-input id="description" v-model="form.description" type="text" name="description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></b-form-input>
                                <has-error :form="form" field="description"></has-error>
                      </b-form-group>

                      <b-form-group
                        label="Unit Price"
                        label-for="price"
                        label-cols-sm="3"
                        label-align-sm="right"
                      >
                        <b-form-input id="price" v-model="form.price" type="text" name="price"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('price') }"></b-form-input>
                                <has-error :form="form" field="price"></has-error>
                      </b-form-group>

                      <b-form-group
                        label="Stock"
                        label-for="stocks"
                        label-cols-sm="3"
                        label-align-sm="right"
                      >
                        <b-form-input id="stocks" v-model="form.stocks" type="text" name="stocks"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('stocks') }"></b-form-input>
                                <has-error :form="form" field="stocks"></has-error>
                      </b-form-group>

                      <b-form-group
                        label="Crit. Level"
                        label-for="criticalLevel"
                        label-cols-sm="3"
                        label-align-sm="right"
                      >
                        <b-form-input id="criticalLevel" v-model="form.criticalLevel" type="text" name="criticalLevel"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('criticalLevel') }"></b-form-input>
                                <has-error :form="form" field="criticalLevel"></has-error>
                      </b-form-group>

                      <b-form-group
                        label="Category"
                        label-for="category_id"
                        label-cols-sm="3"
                        label-align-sm="right"
                      >
                         <select class="form-control" v-model="form.category_id">
                              <option 
                                  v-for="(cat,index) in categories" :key="index"
                                  :value="index"
                                  :selected="index == form.category_id">{{ cat }}</option>
                            </select>
                            <has-error :form="form" field="category_id"></has-error>
                      </b-form-group>

                     <b-form-group
                        v-show="editmode"
                        label="Update Reason"
                        label-for="updateReason"
                        label-cols-sm="3"
                        label-align-sm="right"
                      >
                        <b-form-input id="updateReason" v-model="form.update_reason" type="text" name="updateReason"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('updateReason') }"></b-form-input>
                                <has-error :form="form" field="updateReason"></has-error>
                      </b-form-group>

                      {{form}}

                      <!-- <b-form-group
                        label="Serial Number"
                        label-for="serialno"
                        label-cols-sm="3"
                        label-align-sm="right"
                      >
                        <b-form-input id="serialno" v-model="form.serialno" type="text" name="serialno"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('serialno') }" disabled></b-form-input>
                                <has-error :form="form" field="serialno"></has-error>
                      </b-form-group> -->


                      <!-----------------------> 

                       <!-- <div class="form-group">
                            <small class="text-muted">SKU</small>
                            <input v-model="form.sku" type="text" name="sku"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('sku') }">
                            <has-error :form="form" field="sku"></has-error>
                        </div> -->
                        <!-- <div class="form-group">
                            <small class="text-muted">Name</small>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div> -->
                        <!-- <div class="form-group">
                             <small class="text-muted">Description</small>
                            <input v-model="form.description" type="text" name="description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                            <has-error :form="form" field="description"></has-error>
                        </div> -->
                        <!-- <div class="form-group">
                             <small class="text-muted">Price</small>
                            <input v-model="form.price" type="number" name="price"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                            <has-error :form="form" field="price"></has-error>
                        </div> -->
                        <!-- <div class="form-group">
                             <small class="text-muted">In-Stock</small>
                            <input v-model="form.stocks" type="number" name="stocks"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('stocks') }">
                            <has-error :form="form" field="stocks"></has-error>
                        </div> -->

                         <!-- <div class="form-group">
                             <small class="text-muted">Critical Level</small>
                            <input v-model="form.criticalLevel" type="number" name="criticalLevel"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('criticalLevel') }">
                            <has-error :form="form" field="criticalLevel"></has-error>
                        </div> -->

                        <!-- <div class="form-group">
                             <small class="text-muted">Category</small>
                            <select class="form-control" v-model="form.category_id">
                              <option 
                                  v-for="(cat,index) in categories" :key="index"
                                  :value="index"
                                  :selected="index == form.category_id">{{ cat }}</option>
                            </select>
                            <has-error :form="form" field="category_id"></has-error>
                        </div> -->

                          <!-- <div class="form-group">
                             <small class="text-muted">Serial Number</small>
                            <input v-model="form.serialno" type="number" name="serialno"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('serialno') }">
                            <has-error :form="form" field="serialno"></has-error>
                        </div> -->
                     
                        <!-- <div class="form-group">
                            <label>Tags</label>
                            <vue-tags-input
                              v-model="tag"
                              :tags="form.tags"
                              :autocomplete-items="filteredItems"
                              @tags-changed="newTags => form.tags = newTags"
                            />
                            <has-error :form="form" field="tags"></has-error>
                        </div> -->

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

    <div>
      <div class="container">
       <h1 class="display-4">Items</h1>
       <br>

   
  <!-- <div class="card">
    <div class="card-header" bg-variant="success"> -->
      <b-row>
        <b-col>
          <b-input type="text" v-model="search"></b-input>
        </b-col>
        <b-col cols="2">
          <b-btn id="addbutton" variant="outline-secondary" @click="newModal">
              <b-icon icon="plus"></b-icon>Add New</b-btn>
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
      </div>
    <!-- </div> -->
    <table class="table">
      <thead>
        <th>Item&nbsp;#</th><!--- ID ---->
        <th>Category</th>
        <th>Name</th>
        <th>Description</th>
        <th>Unit Price</th>
        <th>Stock</th>
        <th>Crit.&nbsp;Level</th>
        <th>Sold</th>
        <th>Created&nbsp;By</th>
        <th>Created&nbsp;at</th>
        <th>Updated&nbsp;By</th>
        <th>Updated&nbsp;at</th>
        <th>Update&nbsp;Reason</th>
        <th>Options</th>
      </thead>
      <tbody>
       
        <tr v-for="sam in filteredRows2" :key="sam.id">
          <td v-html="highlightMatches(sam.id)"></td>
          <td v-html="highlightMatches(sam.category.name)"></td>
          <td v-html="highlightMatches(sam.name)"></td>
          <td v-html="highlightMatches(sam.description)"></td>
          <td style="width:10%">&#8369;&nbsp;{{sam.price.toLocaleString()}}.00</td>
          <td v-html="highlightMatches(sam.stocks)" v-if="sam.stocks <= sam.criticalLevel" style="color:red;" class="toCenter"></td>
          <td v-html="highlightMatches(sam.stocks)" v-else class="toCenter"></td>
          <td v-html="highlightMatches(sam.criticalLevel)" class="toCenter"></td>
          <td class="toCenter">{{sam.sold}}</td>
          <td class="toCenter">{{sam.authoredBy}}</td>
          <td class="toCenter">{{new Date(sam.created_at).toLocaleDateString()}}</td>
          <td class="toCenter">{{sam.updatedBy}}</td>  
          <td class="toCenter">{{new Date(sam.updated_at).toLocaleDateString()}}</td>
          <td>{{sam.update_reason}}</td>
          <td>
             <span @click="editModal(sam)" class="optionBtn">
                 <b-icon icon="pencil-square"></b-icon>
             </span>
              |
             <span @click="deleteProduct(sam.id)" class="optionBtn">
                 <b-icon icon="trash"></b-icon>
             </span>
          </td> 
        </tr>
      </tbody>
    </table>

     </div> 
     <!-- <div class="card-footer">
                  <pagination :data="products" @pagination-change-page="getResults"></pagination>
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
                currentUser:'',
                editmode: false,
                 products: {
                  data:[],
                  message:''
                },
                purchaseDetails:{},
                form: new Form({
                    id : '',
                    category : '',
                    name: '',
                    description: '',
                    tags:  [],
                    photo: '',
                    category_id: '',
                    price: '',
                    criticalLevel:'',
                    photoUrl: '',
                    stocks:0,
                    authoredBy:'',
                    updatedBy:'',
                    update_reason:''

                }),
                categories: [],
              
                tag:  '',
                autocompleteItems: [],

                search:'',
                sample:[
                  {name:'hello', age:'10'},
                  {name:'foo', age:'22'},
                  {name:'asa', age:'61'},
                  {name:'dash', age:'35'}

                ],
                 opened: [],
            }
        },
    
        methods: {
          getResults(page = 1) {

              this.$Progress.start();
              
              axios.get('api/product?page=' + page).then(({ data }) => (this.products = data.data.name));

              this.$Progress.finish();
          },
          loadProducts(){

            // if(this.$gate.isAdmin()){
              axios.get("api/product").then(({ data }) => (this.products = data.data));
            // }
          },


          loadPurchasesDetails(){
               axios.get('api/dashboardPurchaseDetails')
                     .then((response)=>{
                       this.purchaseDetails = response.data;

                    console.log("List of PurchaseDetails:");
                      console.log(response.data);

                     }) 
          },


          loadCategories(){
              axios.get("/api/category/list").then(({ data }) => (this.categories = data.data));
          },
          loadTags(){
              axios.get("/api/tag/list").then(response => {
                  this.autocompleteItems = response.data.data.map(a => {
                      return { text: a.name, id: a.id };
                  });
              }).catch(() => console.warn('Oh. Something went wrong'));
          },
          editModal(product){
              this.editmode = true;
              this.form.reset();
              $('#addNew').modal('show');
              this.form.fill(product);
          },
          newModal(){
              this.editmode = false;
              this.form.reset();
              this.form.authoredBy = this.currentUser;
              $('#addNew').modal('show');
          },
          createProduct(){
              this.$Progress.start();
               console.log(this.form);
              this.form.update_reason = 'N/A'
              this.form.post('api/product')
              .then((data)=>{
                if(data.data.success){
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                  this.loadProducts();

                  console.log('success!');
                  console.log(data);

                } else {
                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
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
          updateProduct(){
              this.$Progress.start();
              this.form.updatedBy = this.currentUser;
              if(this.form.update_reason === '') {
                Swal.fire("Oops!", 'Please provide a reason of your update.', "warning");
              } else {
                 this.form.put('api/product/'+this.form.id)
                  .then((response) => {
                      // success
                      $('#addNew').modal('hide');
                      Toast.fire({
                        icon: 'success',
                        title: response.data.message
                      });
                      this.$Progress.finish();
                          //  Fire.$emit('AfterCreate');

                      this.loadProducts();
                  })
                  .catch(() => {
                      this.$Progress.fail();
                  });
              }
             

          },
          deleteProduct(id){
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
                              this.form.delete('api/product/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadProducts();
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
          }

        },
        mounted() {
            
        },
        created() {
            this.$Progress.start();
             axios.get("api/profile")
            .then(({ data }) => (this.currentUser = data.data.name));
           
            this.loadProducts();
            this.loadCategories();
            this.loadTags();

            this. loadPurchasesDetails();

            this.$Progress.finish();
        },
        filters: {
            truncate: function (text, length, suffix) {
                return text.substring(0, length) + suffix;
            },
        },
        computed: {
          filteredItems() {
            return this.autocompleteItems.filter(i => {
              return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
            });
          },

           filteredRows2() {
             const vm = this;
            return vm.products.data.filter(product => {

              const name = product.name.toLowerCase();
              const price = product.price.toString().toLowerCase();
              const description = product.description.toLowerCase();
              const category = product.category.name.toLowerCase();
              const id = product.id.toString().toLowerCase();

               const search = this.search.toLowerCase();

                  return name.includes(search) || price.includes(search) || description.includes(search) || 
              category.includes(search) || id.includes(search);
            
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
}
.optionBtn:hover{
  cursor: pointer;
}
.toCenter{
  text-align: center;
}
tr:hover{
  background-color: #eee;
  cursor: pointer;
}
.exports{
  width:100%;
}
.table {
  font-family:Arial, Helvetica, sans-serif;
  font-size: 13px;
}
</style>
