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
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Category List</a></li>
                            <li class="breadcrumb-item active text-capitalize">Create Category</li>
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
                                    <h3 class="card-title">Create Category</h3>
                                    <router-link :to="{name:'category'}" class="btn btn-outline-dark">Category
                                        List
                                    </router-link>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                                        <form @submit.prevent="submit" enctype="multipart/form-data" method="post">
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Category Name</label>
                                                            <input type="text" name="name" v-model="name"
                                                                   class="form-control"
                                                                   id="name"
                                                                   placeholder="Enter name">
                                                            <div class="alert alert-danger" v-if="errors && errors.name">
                                                                <strong>{{ errors.name[0] }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-row">
                                                            <div class="col-md-3">
                                                                <img :src="imagePreview" alt="" class="img-fluid">
                                                                <span class="text-capitalize" v-if="imagePreview == null">Upload a Thumbnail for category</span>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <div class="input-group mb-3">
                                                                        <div class="custom-file">
                                                                            <input type="file" @change="imageSelected" name="thumbnail"
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
                                                                    <div class="alert alert-danger" v-if="errors && errors.thumbnail">
                                                                        <strong>{{ errors.thumbnail[0] }}</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="text-right pr-3">
                                                <button type="submit" class="btn btn-outline-dark">Save Category
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
            name:null,
            image: '',
            imagePreview:null,
            errors:{},
        }
    },
    methods: {
        imageSelected(e){
            this.image = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(this.image);
            reader.onload = e =>{
                this.imagePreview = e.target.result;
            };
        },
        submit() {
            let formData = new FormData;
            formData.append('name',this.name);
            formData.append('thumbnail',this.image);

            axios.post('/api/categories',formData)
                .then((res)=>{

                    //success massage
                    Toast.fire({
                        icon: 'success',
                        title: 'Category Created successfully'
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

