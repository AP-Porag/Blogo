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
                                        <form @submit.prevent="submit" enctype="multipart/form-data">
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Post Title</label>
                                                            <input type="text" name="name" v-model="fields.name"
                                                                   class="form-control"
                                                                   id="name"
                                                                   placeholder="Enter Title">
                                                        </div>
                                                        <div class="alert alert-danger" v-if="categories == null"></div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="category_id">Select Categories</label>
                                                            <select class="form-control" id="category_id" name="category_id" v-model="fields.category_id">
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
                                                                        <input :value="tag.id" type="checkbox" name="tags[]" v-model="fields.allTags">
                                                                        {{tag.name}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <textarea type="text" name="description" rows="7"
                                                                      class="form-control"
                                                                      id="description"
                                                                      placeholder="Enter description" v-model="fields.description"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-row">
                                                            <div class="col-md-3">
                                                                <img :src="imagePreview" alt="" class="img-fluid">
                                                                <span class="text-capitalize"
                                                                      v-if="imagePreview == null">Upload a Thumbnail for Post</span>
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
            imagePreview:null,
            errors:'',
            fields:{
                name:'',
                category_id:'',
                allTags:[],
                description:'',
                image: '',
            }

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
        },
        imageSelected(e){
            this.fields.image = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(this.fields.image);
            reader.onload = e =>{
                this.imagePreview = e.target.result;
            };
        },
        submit() {
            let formData = new FormData;
            formData.append('name',this.fields.name);
            formData.append('category_id',this.fields.category_id);
            formData.append('tags[]',this.fields.allTags);
            formData.append('description',this.fields.description);
            formData.append('thumbnail',this.fields.image);
            axios.post('/api/posts',formData)
                .then((res)=>{
                    this.fields ={}
                    this.imagePreview = null;
                    //success massage
                    Toast.fire({
                        icon: 'success',
                        title: 'Post Created successfully'
                    });
                    this.errors = {}
                    console.log('success',res);
                })
                .catch((err)=>{
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors
                    }
                    console.log(err);
                })
        }
    }
}
</script>
