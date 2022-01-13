<template>
    <div class="post">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Post</h3>
                            <div class="card-tools">
                                <router-link to="/admin/post/create" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                    Add Post
                                </router-link>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Author Name</th>
                                    <th>Category Name</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(post, index) in getAllPosts" :key="post.id">
                                    <td>{{index + 1}}</td>
                                    <td v-if="post.user">{{post.user.name}}</td>
                                    <td v-if="post.category">{{post.category.name}}</td>
                                    <td v-if="post.title">{{post.title}}</td>
                                    <td v-if="post.image">
                                        <img :src="`/uploads/post/${post.image}`" alt="postImg" width="80" height="60">
                                    </td>
                                    <td>{{post.description.substring(0, 15) + '...'}}</td>
                                    <td>
                                        <router-link :to="`/admin/post/edit/${post.id}`" class="btn btn-info btn-sm">
                                            <i class="nav-icon fa fa-edit"></i>
                                        </router-link>
                                        <button class="btn btn-danger btn-sm mx-2" @click="deletePost(post.id)">
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
        name: "IndexComponent",
        data(){
            return{

            }
        },
        mounted(){
           this.$store.dispatch('getAllPost');
        },
        computed:{
            getAllPosts(){
                return this.$store.getters.getAllPost;
            }
        },
        methods:{
            deletePost(id){
                if (confirm()){
                    axios.get('/admin/post/destroy/'+id)
                        .then(res => {
                            this.$store.dispatch('getAllPost');
                            Toast.fire({
                                icon: 'success',
                                title: 'Post Added successfully'
                            });
                        })
                        .catch(err =>{
                            console.log(err)
                        })
                }

            }
        }
    }
</script>

<style scoped>

</style>
