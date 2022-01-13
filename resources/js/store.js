
const store = {
    state(){
        return{
            categories: [],
            posts: [],
            blogpost: [],
            singlepost: [],
            blogcategories: [],
            latestpost: []
        }
    },
    mutations:{
        //category
        getAllCategory(state, data){
            return state.categories = data;
        },
        //posts
        getAllPost(state, data){
            return state.posts = data;
        },
        //blogpost
        allBlogPost(state, data){
            return state.blogpost = data;
        },
        //singlepost
        singlepost(state, data){
            return state.singlepost = data;
        },
        blogcategories(state, data){
            return state.blogcategories = data;
        },
        latestPost(state, data){
            return state.latestpost = data;
        },
        getCategoryPost(state, data){
            return state.blogpost = data;
        },
        searchResult(state, data){
            return state.blogpost = data;
        }
    },
    actions:{
        //category
        getCategory(context){
            axios.get('/admin/category')
                .then((response)=>{
                    context.commit('getAllCategory', response.data.categories);
                })
                .catch((err)=> {
                    console.log(err);
                })
        },
        //posts
        getAllPost(context){
            axios.get('/admin/post')
                .then((res)=>{
                    context.commit('getAllPost', res.data.posts);
                })
                .catch(err => {
                    console.log(err);
                })
        },
        //blogpost
        getBlogPost(context){
            axios.get('/blog')
                .then(res =>{
                    context.commit('allBlogPost', res.data.posts);
                })
                .catch(err => {
                    console.log(err);
                })
        },
        //single post
        getsinglepost(context, payload){
            axios.get('/post/'+payload)
                .then(res => {
                    context.commit('singlepost', res.data.post)
                })
                .catch(err =>{
                    console.log(err);
                })
        },
        // blogcategories
        blogcategories(context){
            axios.get('/blog/categories')
                .then(res => {
                    context.commit('blogcategories', res.data.categories);
                })
                .catch(err => {
                    console.log(err);
                })
        },
        getLatestPost(context){
            axios.get('/latest-post')
                .then(res =>{
                    context.commit('latestPost', res.data.post);
                })
                .catch(err => {
                    console.log(err);
                })
        },
        // post by category
        PostByCategory(context, payload){
            axios.get('/category/post/'+payload)
                .then(res =>{
                    console.log(res);
                    context.commit('getCategoryPost', res.data.posts);
                })
                .catch(err => {
                    console.log(err);
                })
        },
        realTimeSearch(context, payload){
            axios.get('/search?s='+payload)
                .then(res =>{
                    context.commit('searchResult', res.data.posts);
                })
                .catch(err => {
                    console.log(err);
                })
        }
    },
    getters:{
        //category
        getAllCategory(state){
            return state.categories;
        },
        //posts
        getAllPost(state){
            return state.posts;
        },
        //blogpost
        allBlogPost(state){
            return state.blogpost
        },
        //singlepost
        singlepost(state){
            return state.singlepost
        },
        blogcategories(state){
            return state.blogcategories;
        },
        latestPost(state){
            return state.latestpost;
        },
        getPostByCategory(state){
            return state.blogpost;
        }

    },

};

export default store;
