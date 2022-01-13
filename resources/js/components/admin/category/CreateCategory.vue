<template>
    <div class="category">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add category</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="addCategory">
                                <AlertErrors :form="form" />
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">category Name</label>
                                        <input type="text" v-model="form.name" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Category Name">
<!--                                        <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />-->
                                        <HasError :form="form" field="name" />
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" :disabled="form.busy" class="btn btn-primary">Submit</button>
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
                    'name': '',
                })
            }
        },
        methods:{
            addCategory(){
                this.form.post('/admin/category/store')
                    .then((response) => {
                        this.$router.push('/admin/category');
                        Toast.fire({
                            icon: 'success',
                            title: 'Category Added successfully'
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
