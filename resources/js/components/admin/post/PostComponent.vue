<template>
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Post</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link to="/home">Admin</router-link>
                            </li>
                            <li class="breadcrumb-item active text-capitalize">Post List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-2">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Post List</h3>
                                    <router-link :to="{name:'post-create'}" class="btn btn-outline-dark">Create Post</router-link>
                                </div>
                            </div>
                            <div class="card-body">

                                <table class="table table-hover text-nowrap table-striped">
                                    <thead class="bg-gradient-navy">
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Author Name</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Comments</th>
                                        <th>Tags</th>
                                        <th>Image</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(post,index) in posts.data" :key="post.id">
                                        <td>{{(posts.current_page*10)-10 + index+1}}</td>
                                        <th>{{ post.category.name}}</th>
                                        <th>{{post.user.name}}</th>
                                        <td>{{ post.name | shortTitle}}</td>
                                        <td>{{ post.description | shortDesc }}</td>
                                        <th>{{post.comments.length}}</th>
                                        <td>
<!--                                            {{post.tags.length}}-->
                                            <span class="badge badge-primary mr-2" v-for="tag in post.tags" :key="tag.id">{{tag.name}}</span>
                                        </td>
                                        <td>
                                            <div class="card-img">
                                                <img :src="post.thumbnail" alt="" class="img-fluid" style="max-height: 80px;max-width: 100px;">
                                            </div>
                                        </td>
                                        <td class="text-center d-flex">
                                            <a href="#" class="btn btn-info btn-sm mr-3"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning btn-sm mr-3"><i
                                                class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr v-if="posts == null">
                                        <td colspan="9" class="alert alert-default-info text-indigo text-center">
                                            <h5>No Post found</h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="pagination justify-content-end">

                                    <pagination :data="posts" @pagination-change-page="getResults"></pagination>
<!--                                    <span class="text-right"></span>-->
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</template>
<style scoped>

</style>
<script>
export default {
    data: function () {
        return {
            posts: {},
        }
    },
    filters: {
        shortDesc: function (string) {
            return string.substring(0, 50) + '...';
        },
        shortTitle: function (string) {
            return string.substring(0, 30) + '...';
        }
    },
    mounted() {
        this.loadCategories();
    },
    methods: {
        getResults(page = 1) {
            axios.get('api/posts?page=' + page)
                .then(response => {
                    this.posts = response.data;
                });
        },
        loadCategories: function () {
            //load API
            axios.get('/api/posts')
                //assign this to categories array/object
                .then((res) => {
                    this.posts = res.data;
                })
                //catch error
                .catch(function (err) {
                    console.log(err);
                });


        }
    }
}
</script>
