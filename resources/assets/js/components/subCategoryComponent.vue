<template>
    <div>
        <div class="row">
        
            <div class="col-md-11">
                <div>
                    <div>
                        <button @click="initAddSubCategory()" class="btn btn-primary btn-xs pull-right">
                            + Add New Sub-Category
                        </button>
                        <h3><strong>Sub-Category</strong></h3>
                    </div>
                    <div class="alert alert-success" v-if="success.length > 0">
                            <ul>
                                <li v-for="suc in success">{{ suc }}</li>
                            </ul>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="subCategoryUpdateModelData.length > 0">
                            <tbody>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Active
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            <tr v-for="(category, index) in subCategoryUpdateModelData">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    {{ category.name }}
                                </td>
                                <td>
                                    <div v-if="category.is_active==1">Yes</div>
                                    <div v-if="category.is_active==0">No</div>
                                </td>
                                <td>
                                    <button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button>
                                    <button @click="deleteSubCategory(index)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_sub_category_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Sub-Category</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <div class="alert alert-danger" v-if="internal.length > 0">
                            <ul>
                                <li v-for="inter in internal">{{ inter }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                   v-model="subCategoryModel.name">
                        </div>
                        <div class="form-group">
                            <label for="categories_id" name="categories_id">Parent Category:</label>
                            <select id="categories_id" name="categories_id" class="form-control" v-model="subCategoryModel.categories_id">
                                <option value="">Select Category </option>
                                <option v-for="(category,id,name) in subCategory" v-bind:value="category.id"> {{category.name}} </option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="is_active">isActive:</label>
                            <input type ="checkbox" name="is_active" id="is_active"  v-model="subCategoryModel.is_active">
                        </div>
                        <div class="form-group">
                            <label for="available">Avaliable:</label>
                            <input type ="radio" name="available" id="available"
                                     v-model="subCategoryModel.available" value="0">No
                            <input type ="radio" name="available" id="available"
                                     v-model="subCategoryModel.available" value="1">Yes
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createCategory" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="update_category_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Category</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <div class="alert alert-danger" v-if="internal.length > 0">
                            <ul>
                                <li v-for="inter in internal">{{ inter }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                   v-model="subCategoryUpdateModel.name">
                        </div>
                        <div class="form-group">
                            <label for="categories_id" name="categories_id">Parent Category:</label>
                            <select id="categories_id" name="categories_id" class="form-control" v-model="subCategoryUpdateModel.categories_id">
                                <option value="">Select Category </option>
                                <option v-for="(category,id,name) in subCategory" v-bind:value="category.id"> {{category.name}} </option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="is_active">isActive:</label>
                            <input type ="checkbox" name="is_active" id="is_active"  v-model="subCategoryUpdateModel.is_active">
                        </div>
                        <div class="form-group">
                            <label for="available">Avaliable:</label>
                            <input type ="radio" name="available" id="available"
                                     v-model="subCategoryUpdateModel.available" value="0">No
                            <input type ="radio" name="available" id="available"
                                     v-model="subCategoryUpdateModel.available" value="1">Yes
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateCategory" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        

    </div>
</template>

<script>
    export default {
        data(){
            return {
                subCategoryModel: {
                    name: '',
                    categories_id: '',
                    available: '',
                    is_active: '',
                },//this is for category creation time set all data null
                errors: [],//errors varidale define as null
                subCategoryUpdateModelData: [],//this varidale define as null when instant changes in table
                subCategoryUpdateModel: {},  //this varidale for get value from the model
                success: [],
                internal: [],
                subCategory: [],
                categories: [],

            }
        },
        mounted()
        {
        this.subCategory = [];
                axios.get('api/getSubCategory')
                .then(response => {
                    this.subCategory = response.data.categories;
                })
            this.readCategory();//call when page load
        },
        methods: {
            initAddSubCategory()
            {
                
                $("#add_sub_category_model").modal("show");//show category popup when create
            },
            createCategory()
            {
                //create category and axios used to set methods and hit api.
                axios.post('/api/subCategory', {
                    name: this.subCategoryModel.name,
                    categories_id: this.subCategoryModel.categories_id,
                    available: this.subCategoryModel.available,
                    is_active: this.subCategoryModel.is_active,

                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                        if (response.data.success == true){
                            this.success = [];
                            this.success.push('Sub-Category created successfully!.');
                        this.reset();//reset this value
                        this.subCategoryUpdateModelData.push(response.data.categories);//assign responce data to the subCategoryUpdateModelData model to fetch data instantly
                        $("#add_sub_category_model").modal("hide");//hide model
                        }
                        if (response.data.success == false){
                            this.internal = [];
                            this.internal.push(response.data.error);
                        }

                    })
                    .catch(error => {
                        //error handling
                        this.errors = [];
                        if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
                        if (error.response.data.errors.categories_id) {
                            this.errors.push(error.response.data.errors.categories_id[0]);
                        }
                    });
            },
            reset()
            {
                //reset all the vue models data
                this.subCategoryModel.name = '';
                this.subCategoryModel.categories_id = '';
                this.subCategoryModel.available = '';
                this.subCategoryModel.is_active = '';
            },
            readCategory()
            {
            //get all the subcategory list
            //get request using axios
                axios.get('/api/subCategory')
                    .then(response => {
                        this.subCategoryUpdateModelData = response.data.subCategories;//asign responce to the subCategoryUpdateModelData
                    });
            },
            initUpdate(index)
            {
                //set data for update perticular id
                this.errors = [];
                $("#update_category_model").modal("show");
                this.subCategoryUpdateModel = this.subCategoryUpdateModelData[index];
            },
            updateCategory()
            {
            
                //send data to the api for update
                axios.patch('/api/subCategory/' + this.subCategoryUpdateModel.id, {
                    name: this.subCategoryUpdateModel.name,
                    categories_id: this.subCategoryUpdateModel.categories_id,
                    available: this.subCategoryUpdateModel.available,
                    is_active: this.subCategoryUpdateModel.is_active,
                    

                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                    if (response.data.success == true){
                    this.success = [];
                        this.success.push('Sub-Category updated successfully!.');
                        $("#update_category_model").modal("hide");//hide model
                    }
                    if (response.data.success == false){
                            this.internal = [];
                            this.internal.push(response.data.error);
                        }
                    })
                    .catch(error => {

                        this.errors = [];
                       if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
                        if (error.response.data.errors.categories_id) {
                            this.errors.push(error.response.data.errors.categories_id[0]);
                        }
                    });
            },
            deleteSubCategory(index)
            {
                //delete perticular data
                let conf = confirm("Do you ready want to delete this Sub-Category?");
                if (conf === true) {
                    axios.delete('/api/subCategory/' + this.subCategoryUpdateModelData[index].id)
                        .then(response => {
                            if (response.data.success == true){
                            this.success = [];
                                this.success.push('Sub-Category deleted successfully!.');
                            }
                            this.subCategoryUpdateModelData.splice(index, 1);

                        })
                        .catch(error => {

                        });
                }
            }
        }
    }
</script>