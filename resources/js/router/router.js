import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

//Backend Component Start Here
import Home from "../components/admin/DashboardComponent";
import Example from "../components/ExampleComponent";
import Category from "../components/admin/category/CategoryComponent";
import CategoryCreate from "../components/admin/category/CategoryCreateComponent";
import Post from "../components/admin/post/PostComponent";
import PostCreateComponent from "../components/admin/post/PostCreateComponent";
import Tag from "../components/admin/tag/TagComponent";
import TagCreate from "../components/admin/tag/TagCreateComponent";
import Comment from "../components/admin/comment/CommentComponent";
import Reply from "../components/admin/reply/ReplyComponent";
import CommentComponent from "../components/admin/comment/CommentComponent";

const routes = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            component: Home,
            name:'home'
        },
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
            path: "/category-create",
            component: CategoryCreate,
            name: 'category-create'
        },
        {
            path: "/post",
            component: Post,
            name: 'post'
        },
        {
            path: "/post-create",
            component: PostCreateComponent,
            name: 'post-create'
        },
        {
            path: "/tag",
            component: Tag,
            name: 'tag'
        },
        {
            path: "/tag-create",
            component: TagCreate,
            name: 'tag-create'
        },
        {
            path: "/comment",
            component: Comment,
            name: 'comment'
        },
        {
            path: "/reply",
            component: Reply,
            name: 'reply'
        },

    ]
});

export default routes;
