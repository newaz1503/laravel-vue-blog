<template>
    <div class="sidebar">
        <div class="span4">
            <aside class="right-sidebar">
                <div class="widget">
                    <form class="form-search">
                        <input placeholder="Type something" @keyup="RealtimeSearch" type="text" v-model="keyword" class="input-medium search-query">
                        <button type="submit" @click.prevent="RealtimeSearch" class="btn btn-square btn-theme">Search</button>
                    </form>
                </div>
                <div class="widget">
                    <h5 class="widgetheading">Categories</h5>
                    <ul class="cat">
                        <li v-for="(category) in categories"><i class="icon-angle-right"></i><router-link :to="`/category/post/${category.id}`">{{category.name}}</router-link><span> (20)</span></li>

                    </ul>
                </div>
                <div class="widget">
                    <h5 class="widgetheading">Latest posts</h5>
                    <ul class="recent">
                        <li v-for="(post, index) in latestPost">
                            <img :src="`/uploads/post/${post.image}`" class="pull-left" alt="post image" width="40" />
                            <h6><router-link :to="`/blog/${post.id}`">{{post.title}}</router-link></h6>
                            <p>
                                {{post.description.slice(0, 10)+ '...'}}
                            </p>
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';
    export default {
        name: "BlogSidebar",
        data(){
            return{
                keyword: '',
            }
        },
        mounted(){
            this.$store.dispatch('blogcategories');
            this.$store.dispatch('getLatestPost');
        },
        computed:{
            categories(){
                return this.$store.getters.blogcategories
            },
            latestPost(){
                return this.$store.getters.latestPost;
            }
        },
        methods:{
            RealtimeSearch: _.debounce(function(){
                this.$store.dispatch('realTimeSearch', this.keyword);
            }, 1000)
        },

    }
</script>

<style scoped>

</style>
