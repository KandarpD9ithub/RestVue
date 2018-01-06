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
                                    <input type="checkbox" name="create" value="">Create &nbsp;&nbsp;
&nbsp; &nbsp;<input type="checkbox" name="edit" value="">Edit &nbsp;&nbsp;
&nbsp; &nbsp;<input type="checkbox" name="delete" value="">Delete 
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
                axios.get('/api/users')
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