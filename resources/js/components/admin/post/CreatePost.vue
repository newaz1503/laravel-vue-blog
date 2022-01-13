<template>
    <div class="post">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add New Post</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="addPost()" enctype="multipart/form-data">
                                <AlertErrors :form="form" />
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">category Name</label>
                                        <select name="category_id" v-model="form.category_id" class="form-control" id="exampleInputEmail1">
                                            <option value="" selected disabled>Select Category</option>
                                            <option v-for="category in getAllCategory" :value="category.id">{{category.name}}</option>
                                        </select>
                                        <HasError :form="form" field="category_id" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInput">Post Title</label>
                                        <input type="text" v-model="form.title" name="title" class="form-control" id="exampleInput" placeholder="Enter Post title">
                                        <HasError :form="form" field="title" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInput">Post description</label>
                                        <textarea rows="5" v-model="form.description" name="description" class="form-control" id="exampleInput" placeholder="Enter Post Description"> </textarea>
                                        <HasError :form="form" field="description" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInput" style="display: block">feature Image</label>
                                        <input type="file" v-model="form.image" name="image" @change="imageChange($event)">
                                        <HasError :form="form" field="image" />
                                        <img v-if="form.image" :src="form.image" alt="" width="120" height="80">
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
    </div>
</template>

<script>
    export default {
        name: "CreatePost",
        data(){
            return{
                form: new Form({
                    'category_id' : '',
                    'title': '',
                    'description': '',
                    'image': '',

                 })
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
            imageChange(event){
                let file = event.target.files[0];
                if (file.size > 2000000){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Image size is too big',
                    })
                }else{
                    let reader = new FileReader();
                    reader.onload = (event) => {
                        this.form.image = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
            addPost(){
                this.form.post('/admin/post/store')
                    .then(res => {
                        this.$router.push('/admin/post');
                        Toast.fire({
                            icon: 'success',
                            title: 'Post Added successfully'
                        });
                    })
                    .catch(err=>{
                        console.log(err)
                    })
            }
        },

    }
</script>

<style scoped>

</style>
