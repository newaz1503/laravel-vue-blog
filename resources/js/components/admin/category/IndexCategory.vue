<template>
    <div class="category">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Category</h3>
                            <div class="card-tools">
                                <router-link to="/admin/category/create" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                    Add Category
                                </router-link>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        <select @change="deleteAllChecked()" v-model="selected">
                                            <option value="" selected disabled>Select</option>
                                            <option value="">Delete selected</option>
                                        </select><br>
                                        <label for="selectAll">
                                            <input type="checkbox" @click="selectAllBox" id="selectAll" v-model="all_selected">
                                            <span v-if="this.all_selected == false">Check All</span>
                                            <span v-else>Uncheck All</span>
                                        </label>
                                    </th>
                                    <th>Serial No</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(category, index) in getAllCategory" :key="category.id">
                                    <td><input type="checkbox" v-model="selectedId" :value="category.id"></td>
                                    <td>{{index + 1}}</td>
                                    <td>{{category.name}}</td>
                                    <td>{{getFormattedTime(category.created_at)}}</td>
                                    <td>
                                        <router-link :to="'/admin/category/edit/'+category.id" class="btn btn-info btn-sm">
                                            <i class="nav-icon fa fa-edit"></i>
                                        </router-link>
                                        <button @click="deleteCategory(category.id)"  class="btn btn-danger btn-sm mx-2">
                                            <i class="nav-icon fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
</template>

<script>
    export default {
        name: "index",
        data(){
            return{
                selectedId: [],
                selected: "",
                all_selected: false,
            }
        },
        mounted(){
           this.$store.dispatch("getCategory");
        },
        computed:{
            getAllCategory(){
                return this.$store.getters.getAllCategory;
            },

        },
        methods:{
            getFormattedTime(arg){
                return moment(arg).format("dddd, MMMM Do YYYY");
            },
            deleteCategory(id){
                if (confirm()){
                    axios.get('/admin/category/destroy/'+id)
                        .then((res)=>{
                            this.$store.dispatch("getCategory");
                            Toast.fire({
                                icon: 'success',
                                title: 'Category Deleted successfully'
                            });
                        })
                        .catch((err)=>{
                            console.log(err);
                        })
                }
            },
            deleteAllChecked(){
                axios.get('/admin/category-destroy/'+this.selectedId)
                    .then(res => {
                        this.selectedId = [];
                        this.$store.dispatch("getCategory");
                        Toast.fire({
                            icon: 'success',
                            title: 'Category Deleted successfully'
                        });
                    })
                    .catch(err =>{
                        console.log(err)
                    })
            },
            selectAllBox(){
                if(this.all_selected == false){
                    this.all_selected = true;
                    for (let category in this.getAllCategory) {
                        this.selectedId.push(this.getAllCategory[category].id);
                    }
                }else {
                    this.all_selected = false;
                    this.selectedId = []
                }
            }
        }
    }
</script>

<style scoped>
    .router-link-active{
        background-color: #0a53be;
    }
</style>
