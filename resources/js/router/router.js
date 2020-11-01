import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

//Backend Component Start Here
import Home from "../components/admin/DashboardComponent";
import Example from "../components/ExampleComponent";
import Category from "../components/admin/category/CategoryComponent";
import Post from "../components/admin/post/PostComponent";
import Tag from "../components/admin/tag/TagComponent";

const routes = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/home",
            component: Home,
            name:'home'
        },
        {
            path: "/category",
            component: Category,
            name: 'category'
        },
        {
            path: "/post",
            component: Post,
            name: 'post'
        },
        {
            path: "/tag",
            component: Tag,
            name: 'tag'
        }
    ]
});

export default routes;
