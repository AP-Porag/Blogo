<template>
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tag</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Tag List</a></li>
                            <li class="breadcrumb-item active text-capitalize">Create Tag</li>
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
                                    <h3 class="card-title">Create Tag</h3>
                                    <a href="#" class="btn btn-outline-dark">Tag
                                        List</a>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
<!--                                        <div class="alert alert-success" v-show="success">Tag Created Successfully.-->
<!--                                        </div>-->
                                        <form @submit.prevent="submit">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="name">Tag Name</label>
                                                    <input type="text" name="name"
                                                           class="form-control" id="name"
                                                           placeholder="Enter name" v-model="fields.name">
                                                    <div class="alert alert-danger" v-if="errors && errors.name">
                                                        <strong>{{ errors.name[0] }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer text-right">
                                                <button type="submit" class="btn btn-outline-dark">Save Tag
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
            fields: {},
            //success: false,
            errors: {},
        }
    },
    methods: {
        submit() {
            axios.post('/api/tags', this.fields)
                .then(res => {
                    this.fields = {};
                    //this.success = true;
                    Toast.fire({
                        icon: 'success',
                        title: 'Tag Created successfully'
                    });
                    this.errors = {}
                })
                .catch(err => {
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors
                    }

                    console.log(err);

                })
        }
    }
}
</script>
<style></style>
