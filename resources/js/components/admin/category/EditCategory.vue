<template>
    <div class="category-add">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit category</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="updateCategory">
                                <AlertErrors :form="form" />
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">category Name</label>
                                        <input type="text" v-model="form.name" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Category Name">
                                        <HasError :form="form" field="name" />
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" :disabled="form.busy" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
    export default {
        name: "CreateCategory",

        data(){
            return{
                form: new Form({
                    'id': '',
                    'name': '',
                })
            }
        },
        mounted(){
          axios.get('/admin/category/edit/'+this.$route.params.id)
          .then((res)=>{
                this.form.fill(res.data.category)
            })
          .catch((err)=>{
              console.log(err);
            })
        },
        methods:{
            updateCategory(){
                this.form.post('/admin/category/update/'+this.$route.params.id)
                    .then((response) => {
                        this.$router.push('/admin/category');
                        Toast.fire({
                            icon: 'success',
                            title: 'Category Updated successfully'
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            }
        }

    }
</script>

<style scoped>

</style>
