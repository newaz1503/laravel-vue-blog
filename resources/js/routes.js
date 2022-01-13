import AdminDashboard from './components/admin/Dashboard';
//category
import CategoryIndex from './components/admin/category/IndexCategory';
import AddCategory from './components/admin/category/CreateCategory';
import EditCategory from './components/admin/category/EditCategory';
//post
import PostIndex from './components/admin/post/IndexComponent';
import AddPost from './components/admin/post/CreatePost';
import EditPost from './components/admin/post/EditPost';

//Home/Front page routing
import HomePage from './components/home/Home';
import BlogPage from './components/home/Blog';
import BlogDetails from './components/home/BlogDetails';

const routes = [
    {
        path: '/admin/dashboard',
        component: AdminDashboard
    },
    //category
    {
        path: '/admin/category',
        component: CategoryIndex
    },
    {
        path: '/admin/category/create',
        component: AddCategory
    },
    {
        path: '/admin/category/edit/:id',
        component: EditCategory
    },
    //post
    {
        path: '/admin/post',
        component: PostIndex
    },
    {
        path: '/admin/post/create',
        component: AddPost
    },
    {
        path: '/admin/post/edit/:id',
        component: EditPost
    },

    //Home/Front Page router
    {
        path: '/',
        component: HomePage
    },
    {
        path: '/blog',
        component: BlogPage
    },
    {
        path: '/blog/:id',
        component: BlogDetails
    },
    {
        path: '/category/post/:id',
        component: BlogPage
    },

];

export default routes;
