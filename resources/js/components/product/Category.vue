<template>
  <section class="content">
    <div class="container">
        <br>
        <h1 class="display-4">Category</h1>
        <div class="row">
          <div class="col-12">
            <div v-if="$gate.isAdmin()">
                <div class="text-right pull-right">
                    <b-btn @click="newModal" variant="outline-secondary">
                        <b-icon icon="plus"></b-icon>
                        Add New
                    </b-btn>
                </div>
              <!-- /.card-header -->
              <div>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Warranty&nbsp;Days</th>
                      <th>Created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="category in categories.data" :key="category.id">

                      <td>{{category.id}}</td>
                      <td class="text-capitalize">{{category.name}}</td>
                      <td>{{category.description}}</td>
                      <td>{{category.warranty}}</td>
                      <td>{{category.created_at}}</td>
                      <td>

                        <a href="#" @click="editModal(category)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer">
                  <pagination :data="categories" @pagination-change-page="getResults"></pagination>
              </div> -->
            </div>
            <!-- /.card -->
          </div>
        </div>


        <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Create New Category</h5>
                    <h5 class="modal-title" v-show="editmode">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- <form @submit.prevent="createUser"> -->

                <form @submit.prevent="editmode ? updateCategory() : createCategory()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input v-model="form.description" type="text" name="description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                            <has-error :form="form" field="description"></has-error>
                        </div>
                         <div class="form-group">
                            <label>Warranty</label>
                            <input v-model="form.warranty" type="text" name="warranty"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('warranty') }">
                            <has-error :form="form" field="warranty"></has-error>
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
    </div>
  </section>
</template>

<script>
    export default {
        data () {
            return {
                editmode: false,
                categories : {},
                form: new Form({
                    id : '',
                    name: '',
                    description: '',
                    warranty:''
                })
            }
        },
        methods: {

            getResults(page = 1) {

                  this.$Progress.start();
                  
                  axios.get('/api/category?page=' + page).then(({ data }) => (this.categories = data.data));

                  this.$Progress.finish();
            },
            updateCategory(){
                this.$Progress.start();
                this.form.put('/api/category/'+this.form.id)
                .then((response) => {
                    // success
                    $('#addNew').modal('hide');
                    Toast.fire({
                      icon: 'success',
                      title: response.data.message
                    });
                    this.$Progress.finish();
                        //  Fire.$emit('AfterCreate');

                    this.loadCategories();
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
            editModal(category){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(category);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },

            loadCategories(){
                if(this.$gate.isAdmin()){
                    axios.get("/api/category").then(({ data }) => (this.categories = data.data));
                }
            },
            
            createCategory(){

                this.form.post('/api/category')
                .then((response)=>{
                    $('#addNew').modal('hide');

                    Toast.fire({
                            icon: 'success',
                            title: response.data.message
                    });

                    this.$Progress.finish();
                    this.loadCategories();
                })
                .catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
            }

        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {

            this.$Progress.start();
            this.loadCategories();
            this.$Progress.finish();
        }
    }
</script>
<style scoped>
.content {
  font-family: Arial, Helvetica, sans-serif;
}
</style>
