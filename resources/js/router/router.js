import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

//Backend Component Start Here
// import CategoryList from "../components/backend/CategoryListComponent";
// import Dashboard from "../components/backend/Dashboard";
// import EditCategory from "../components/backend/EditCategory";

const routes = new VueRouter({
    mode: "history",
    routes: [
        // {
        //     path: "/",
        //     component: Dashboard
        // },
        // {
        //     path: "/dashboard",
        //     component: Dashboard
        // },
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
