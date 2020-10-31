import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

//Backend Component Start Here
import Dashboard from "../components/admin/DashboardComponent";
import Example from "../components/ExampleComponent";
import Category from "../components/admin/category/CategoryComponent";
import Post from "../components/admin/post/PostComponent";
// import CategoryList from "../components/backend/CategoryListComponent";
// import Dashboard from "../components/backend/Dashboard";
// import EditCategory from "../components/backend/EditCategory";

const routes = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/dashboard",
            component: Dashboard,
        },
        {
            path: "/example",
            component: Example
        },
        {
            path: "/category",
            component: Category
        },
        {
            path: "/post",
            component: Post
        },
        // {
        //     path: "/category",
        //     component: CategoryList
        // },
        // {
        //     path: "/category/edit/:id",
        //     component: EditCategory,
        //     name: "edit-category"
        // }
    ]
});

export default routes;
