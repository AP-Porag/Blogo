<template>
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link to="/dashboard">Admin</router-link>
                            </li>
                            <li class="breadcrumb-item active text-capitalize">Category List</li>
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
                                    <h3 class="card-title">Category List</h3>
                                    <router-link :to="{name:'category-create'}" class="btn btn-outline-dark">Create category</router-link>
                                </div>
                            </div>
                            <div class="card-body">

                                <table class="table table-hover text-nowrap table-striped">
                                    <thead class="bg-gradient-navy">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Post Count</th>
                                        <th>Image</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(category,index) in categories" :key="category.id">
                                        <td>{{index+1}}</td>
                                        <td>{{category.name}}</td>
                                        <td>{{category.slug}}</td>
                                        <td>{{category.posts.length}}</td>
                                        <td>
                                            <div class="card-img">
                                                <img :src="category.thumbnail" alt="" class="img-fluid" style="max-height: 80px;max-width: 100px;">
                                            </div>
                                        </td>
                                        <td class="text-center d-flex">
                                            <a href="#" class="btn btn-info btn-sm mr-3"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="btn btn-warning btn-sm mr-3"><i
                                                class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr v-if="categories == null">
                                        <td colspan="6" class="alert alert-default-info text-indigo text-center">
                                            <h5>No Category found</h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="pagination justify-content-end">
                                    <span class="text-right"></span>
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
            categories: [],
        }
    },
    mounted() {
        this.loadCategories();
    },
    methods: {
        loadCategories: function () {
            //load API
            axios.get('/api/categories')
                //assign this to categories array/object
                .then((res)=>{
                    this.categories = res.data.data;
                })
                //catch error
                .catch(function (err){
                    console.log(err);
                });


        }
    }
}
</script>
