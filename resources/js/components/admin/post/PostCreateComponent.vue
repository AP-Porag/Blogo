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
                                <router-link :to="{name:'home'}">Admin</router-link>
                            </li>
                            <li class="breadcrumb-item">
                                <router-link :to="{name:'post'}">Post List</router-link>
                            </li>
                            <li class="breadcrumb-item active text-capitalize">Create Post</li>
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
                                    <h3 class="card-title">Create Post</h3>
                                    <router-link :to="{name:'post'}" class="btn btn-outline-dark">Post
                                        List
                                    </router-link>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                                        <form>
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Post Title</label>
                                                            <input type="text" name="name"
                                                                   class="form-control"
                                                                   id="name"
                                                                   placeholder="Enter Title">
                                                        </div>
                                                        <div class="alert alert-danger" v-if="categories == null"></div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Select Categories</label>
                                                            <select class="form-control">
                                                                <option :value="category.id"
                                                                        v-for="category in categories"
                                                                        :key="category.id">{{ category.name }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Select Tags</label>
                                                            <div class="form-group border p-3">
                                                                <div class="checkbox">
                                                                    <label v-for="tag in tags" :key="tag.id" class="mr-3">
                                                                        <input :value="tag.id" type="checkbox">
                                                                        {{tag.name}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Description</label>
                                                            <textarea type="text" name="name" rows="7"
                                                                      class="form-control"
                                                                      id="name"
                                                                      placeholder="Enter Title"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-row">
                                                            <div class="col-md-3">
                                                                <img :src="imagePreview" alt="" class="img-fluid">
                                                                <span class="text-capitalize"
                                                                      v-if="imagePreview == null">Upload a Thumbnail for category</span>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="custom-file">
                                                                            <input type="file" @change="imageSelected"
                                                                                   name="thumbnail"
                                                                                   class="custom-file-input custom-file-label"
                                                                                   id="thumbnail">
                                                                            <label class="custom-file-label"
                                                                                   for="thumbnail"></label>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"
                                                                                  id="">Upload</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="alert alert-danger"
                                                                     v-if="errors && errors.thumbnail">
                                                                    <strong>{{ errors.thumbnail[0] }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer text-right bg-white border-0">
                                                <button type="submit" class="btn btn-outline-dark">Save Post
                                                </button>
                                            </div>
                                        </form>
                                    </div>
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
<script>
export default {
    data() {
        return {
            categories: [],
            tags: [],
        }
    },
    mounted() {
        this.loadCategories();
    },
    methods: {
        loadCategories: function () {
            axios.get('/api/posts/create')
                .then((res) => {
                    this.categories = res.data.categories;
                    this.tags = res.data.tags
                })
                .catch((err) => {
                    console.log(err)
                });
        }
    }
}
</script>
