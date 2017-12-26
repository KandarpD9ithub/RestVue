<template>
    <div>
        <div class="row">
        
            <div class="col-md-11">
                <div>
                    <div>
                        <button @click="initAddCategory()" class="btn btn-primary btn-xs pull-right">
                            + Add New Category
                        </button>
                        <h3><strong>Category</strong></h3>
                    </div>
                    <div class="alert alert-success" v-if="success.length > 0">
                            <ul>
                                <li v-for="suc in success">{{ suc }}</li>
                            </ul>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="categoryUpdateModelData.length > 0">
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
                            <tr v-for="(category, index) in categoryUpdateModelData">
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
                                    <button @click="deleteCategory(index)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_category_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Category</h4>
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
                                   v-model="categoryModel.name">
                        </div>
                        <div class="form-group">
                            <label for="category" name="category">Category:</label>
                            <select id="category" name="category" class="form-control" v-model="categoryModel.category">
                            	<option value="">Select Category </option>
                            	<option v-for="(category,key,value) in categories" v-bind:value="category.value"> {{category.key}} </option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="is_active">isActive:</label>
                            <input type ="checkbox" name="is_active" id="is_active"  v-model="categoryModel.is_active">
                        </div>
                        <div class="form-group">
                            <label for="available">Avaliable:</label>
                            <input type ="radio" name="available" id="available"
                                     v-model="categoryModel.available" value="0">No
                            <input type ="radio" name="available" id="available"
                                     v-model="categoryModel.available" value="1">Yes
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
                                   v-model="categoryUpdateModel.name">
                        </div>
                        <div class="form-group">
                            <label for="category" name="category">Category:</label>
                            <select id="category" name="category" class="form-control" v-model="categoryUpdateModel.category">
                            	<option value="">Select Category </option>
                            	<option v-for="(category,key,value) in categories" v-bind:value="category.value"> {{category.key}} </option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="is_active">isActive:</label>
                            <input type ="checkbox" name="is_active" id="is_active"  v-model="categoryUpdateModel.is_active">
                        </div>
                        <div class="form-group">
                            <label for="available">Avaliable:</label>
                            <input type ="radio" name="available" id="available"
                                     v-model="categoryUpdateModel.available" value="0">No
                            <input type ="radio" name="available" id="available"
                                     v-model="categoryUpdateModel.available" value="1">Yes
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
                categoryModel: {
                    name: '',
                    category: '',
                    available: '',
                    is_active: '',
                },//this is for category creation time set all data null
                errors: [],//errors varidale define as null
                categoryUpdateModelData: [],//this varidale define as null when instant changes in table
                categoryUpdateModel: {},  //this varidale for get value from the model
                success: [],
                internal: [],
                categories: [{'key':'Veg','value':0},{'key':'NonVeg','value':1}],

            }
        },
        mounted()
        {
            this.readCategory();//call when page load
        },
        methods: {
            initAddCategory()
            {
                $("#add_category_model").modal("show");//show category popup when create
            },
            createCategory()
            {
                //create category and axios used to set methods and hit api.
                axios.post('/api/category', {
                    name: this.categoryModel.name,
                    category: this.categoryModel.category,
                    available: this.categoryModel.available,
                    is_active: this.categoryModel.is_active,

                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                        if (response.data.success == true){
                            this.success = [];
                            this.success.push('category created successfully!.');
                        this.reset();//reset this value
                        this.categoryUpdateModelData.push(response.data.categories);//assign responce data to the categoryUpdateModelData model to fetch data instantly
                        $("#add_category_model").modal("hide");//hide model
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
                        if (error.response.data.errors.category) {
                            this.errors.push(error.response.data.errors.category[0]);
                        }
                    });
            },
            reset()
            {
                //reset all the vue models data
                this.categoryModel.name = '';
                this.categoryModel.category = '';
                this.categoryModel.available = '';
                this.categoryModel.is_active = '';
            },
            readCategory()
            {
            //get all the category list
            //get request using axios
                axios.get('/api/category')
                    .then(response => {
                        this.categoryUpdateModelData = response.data.categories;//asign responce to the categoryUpdateModelData
                    });
            },
            initUpdate(index)
            {
                //set data for update perticular id
                this.errors = [];
                $("#update_category_model").modal("show");
                this.categoryUpdateModel = this.categoryUpdateModelData[index];
            },
            updateCategory()
            {
            
                //send data to the api for update
                axios.patch('/api/category/' + this.categoryUpdateModel.id, {
                    name: this.categoryUpdateModel.name,
                    category: this.categoryUpdateModel.category,
                    available: this.categoryUpdateModel.available,
                    is_active: this.categoryUpdateModel.is_active,
                    

                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                    if (response.data.success == true){
                    this.success = [];
                        this.success.push('category updated successfully!.');
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
                        if (error.response.data.errors.category) {
                            this.errors.push(error.response.data.errors.category[0]);
                        }
                    });
            },
            deleteCategory(index)
            {
                //delete perticular data
                let conf = confirm("Do you ready want to delete this category?");
                if (conf === true) {
                    axios.delete('/api/category/' + this.categoryUpdateModelData[index].id)
                        .then(response => {
                            if (response.data.success == true){
                            this.success = [];
                                this.success.push('category deleted successfully!.');
                            }
                            this.categoryUpdateModelData.splice(index, 1);

                        })
                        .catch(error => {

                        });
                }
            }
        }
    }
</script>