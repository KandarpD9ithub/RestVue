<template>
        <div class="row">

            <div class="col-md-11">
                <div>
                    <div>
                        <button @click="initAddProduct()" class="btn btn-primary btn-xs pull-right">
                            + Add New Product
                        </button>
                        <h3><strong>Product</strong></h3>
                    </div>
                    <div class="alert alert-success" v-if="success.length > 0">
                        <ul>
                            <li v-for="suc in success">{{ suc }}</li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="prodcutUpdateModelData.length > 0">
                            <tbody>
                                <tr>
                                    <th>
                                        No.
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                                <tr v-for="(product, index) in prodcutUpdateModelData">
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        {{ product.name }}
                                    </td>
                                    <td>
                                        {{ product.mobile }}
                                    </td>
                                    <td>
                                        <button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button>
                                        <button @click="deleteProduct(index)" class="btn btn-danger btn-xs">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        

        <div class="modal fade" tabindex="-1" role="dialog" id="add_product_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Product</h4>
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
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control" v-model="productModel.name">
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Price" v-model="productModel.price">
                        </div>

                        <div class="form-group">
                            <label for="mobile">category:</label>
                            <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Mobile" v-model="productModel.mobile">
                        </div>

                        <div class="form-group">
                            <label for="category_id" name="category">Category:</label>
                            <select id="category_id" name="category_id" class="form-control" v-model="subCategoryModel.category_id">
                                <option value="">Select Category </option>
                                <option v-for="(category,id,name) in Category" v-bind:value="category.id"> {{category.name}} </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sub_category_id" name="category">Category:</label>
                            <select id="sub_category_id" name="sub_category_id" class="form-control" v-model="subCategoryModel.sub_category_id">
                                <option value="">Select Sub-Category </option>
                                <option v-for="(subcat,id,name) in subCategory" v-bind:value="subcat.id"> {{subcat.name}} </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tax_id" name="category">Tax:</label>
                            <select id="tax_id" name="tax_id" class="form-control" v-model="subCategoryModel.tax_id">
                                <option value="">Tax </option>
                                <option v-for="(tax,id,name) in taxes" v-bind:value="tax.id"> {{tax.name}} </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="is_active">isActive:</label>
                            <input type="checkbox" name="is_active" id="is_active" v-model="productModel.is_active">
                        </div>
                        <div class="form-group">
                            <label for="available">Avaliable:</label>
                            <input type="radio" name="available" id="available" v-model="productModel.available" value="0">No
                            <input type="radio" name="available" id="available" v-model="productModel.available" value="1">Yes
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="text" name="image" id="image" class="form-control" placeholder="image" v-model="productModel.image">
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Description" v-model="productModel.description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="time_duration">Time Duration:</label>
                            <input type="time" name="time_duration" id="time_duration" class="form-control" placeholder="Mobile" v-model="productModel.time_duration">
                        </div>
                 </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" @click="createProduct" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div class="modal fade" tabindex="-1" role="dialog" id="update_product_model">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add New Customer</h4>
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
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control" v-model="productModel.name">
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" name="price" id="price" class="form-control" placeholder="Price" v-model="productModel.price">
                            </div>

                            <div class="form-group">
                                <label for="mobile">category:</label>
                                <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Mobile" v-model="productModel.mobile">
                            </div>

                            <div class="form-group">
                                <label for="category_id" name="category">Category:</label>
                                <select id="category_id" name="category_id" class="form-control" v-model="productUpdateModel.category_id">
                                    <option value="">Select Category </option>
                                    <option v-for="(category,id,name) in category" v-bind:value="category.id"> {{category.name}} </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sub_category_id" name="category">Sub-Category:</label>
                                <select id="sub_category_id" name="sub_category_id" class="form-control" v-model="productUpdateModel.sub_category_id">
                                    <option value="">Select Sub-Category </option>
                                    <option v-for="(subcat,id,name) in subCategory" v-bind:value="subcat.id"> {{subcat.name}} </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tax_id" name="tax_id">Tax:</label>
                                <select id="tax_id" name="tax_id" class="form-control" v-model="productUpdateModel.tax_id">
                                    <option value="">Tax </option>
                                    <option v-for="(tax,id,name) in taxes" v-bind:value="tax.id"> {{tax.name}} </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="is_active">isActive:</label>
                                <input type="checkbox" name="is_active" id="is_active" v-model="productUpdateModel.is_active">
                            </div>
                            <div class="form-group">
                                <label for="available">Avaliable:</label>
                                <input type="radio" name="available" id="available" v-model="productUpdateModel.available" value="0">No
                                <input type="radio" name="available" id="available" v-model="productUpdateModel.available" value="1">Yes
                            </div>

                            <div class="form-group">
                                <label for="image">Image:</label>
                                <textarea name="image" id="mobile" class="form-control" placeholder="image" v-model="productUpdateModel.image" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Description" v-model="productUpdateModel.description" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="time_duration">Time Duration:</label>
                                <input type="time" name="time_duration" id="time_duration" class="form-control" placeholder="Mobile" v-model="productUpdateModel.time_duration">
                            </div>
                          </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" @click="createProduct" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
</template>

<script>
    export default {
        data(){
            return {
                productModel: {
                    name: '',
                    price: '',
                    category_id: '',
                    sub_category_id: '',
                    tax_id: '',
                    available: '',
                    description: '',
                    image: '',
                    is_active: '',
                    time_duration: '',
                },//this is for customer creation time set all data null
                errors: [],//errors varidale define as null
                prodcutUpdateModelData: [],//this varidale define as null when instant changes in table
                productUpdateModel: {},//this varidale for get value from the model
                /*roles: [{'key':1,'value':'Admin'},
                    {'key':2,'value': 'Accountant'},
                    {'key':3,'value': 'Store Manager'},
                    {'key':4,'value': 'Cashier'},
                    {'key':5,'value': 'chef'}],*/
                category : [],
                subCategory : [],
                taxes: [],
                success: [],
                internal: [],
            }
        },
        mounted()
        {
            this.readProducts();//call when page load
            axios.get('/api/categoryList')
                .then(response => {
                    this.category = response.data.categoryList
                });
            axios.get('/api/subCategoryList')
                .then(response => {
                    this.subCategory = response.data.subCategoryList
                });

            axios.get('/api/taxes')
                .then(response => {
                    this.taxes = response.data.taxes
                });
        },
        methods: {
            initAddProduct()
            {
                $("#add_product_model").modal("show");
            },
            createProduct()
            {
                axios.post('/api/products', {
                    name: this.productModel.name,
                    price: this.productModel.price,
                    category_id: this.productModel.category_id,
                    sub_category_id: this.productModel.sub_category_id,
                    tax_id: this.productModel.tax_id,
                    available: this.productModel.available,
                    description: this.productModel.description,
                    image: this.productModel.image,
                    is_active: this.productModel.is_active,
                    time_duration: this.productModel.time_duration,
                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                    if (response.data.success == true){
                        this.success = [];
                        this.success.push('Product created successfully!.');
                        this.reset();//reset this value
                        this.prodcutUpdateModelData.push(response.data.products);//assign responce data to the prodcutUpdateModelData model to fetch data instantly
                        $("#add_product_model").modal("hide");//hide model
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
                        if (error.response.data.errors.price) {
                            this.errors.push(error.response.data.errors.price[0]);
                        }
                        if (error.response.data.errors.category_id) {
                            this.errors.push(error.response.data.errors.category_id[0]);
                        }
                        if (error.response.data.errors.sub_category_id) {
                            this.errors.push(error.response.data.errors.sub_category_id[0]);
                        }
                        if (error.response.data.errors.tax_id) {
                            this.errors.push(error.response.data.errors.tax_id[0]);
                        }

                    });
            },
            reset()
            {
                //reset all the vue models data
                this.productModel.name = '';
                this.productModel.price = '';
                this.productModel.category_id = '';
                this.productModel.sub_category_id = '';
                this.productModel.tax_id = '';
            },
            readProducts()
            {
            //get all the customers list
            //get request using axios
                axios.get('/api/products')
                    .then(response => {
                        this.prodcutUpdateModelData = response.data.products;//asign responce to the prodcutUpdateModelData
                    });
            },
            initUpdate(index)
            {
                //set data for update perticular id
                this.errors = [];
                $("#update_product_model").modal("show");
                this.productUpdateModel = this.prodcutUpdateModelData[index];
            },
            updateProduct()
            {
                //send data to the api for update
                axios.put('/api/products/' + this.productUpdateModel.id, {
                    name: this.productUpdateModel.name,
                    price: this.productUpdateModel.price,
                    category_id: this.productUpdateModel.category_id,
                    sub_category_id: this.productUpdateModel.sub_category_id,
                    tax_id: this.productUpdateModel.tax_id,
                    available: this.productUpdateModel.available,
                    description: this.productUpdateModel.description,
                    image: this.productUpdateModel.image,
                    is_active: this.productUpdateModel.is_active,
                    time_duration: this.productUpdateModel.time_duration,

                })
                    .then(response => {
                    this.errors = [];
                        this.internal = [];
                        if (response.data.success == true){
                        this.success = [];
                            this.success.push('Product updated successfully!.');
                            $("#update_product_model").modal("hide");//hide model
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
                        if (error.response.data.errors.price) {
                            this.errors.push(error.response.data.errors.price[0]);
                        }
                        if (error.response.data.errors.category_id) {
                            this.errors.push(error.response.data.errors.category_id[0]);
                        }
                        if (error.response.data.errors.sub_category_id) {
                            this.errors.push(error.response.data.errors.sub_category_id[0]);
                        }
                        if (error.response.data.errors.tax_id) {
                            this.errors.push(error.response.data.errors.tax_id[0]);
                        }
                    });
            },
            deleteProduct(index)
            {
                //delete perticular data
                let conf = confirm("Do you ready want to delete this Product?");
                if (conf === true) {
                    axios.delete('/api/products/' + this.prodcutUpdateModelData[index].id)
                        .then(response => {

                            this.prodcutUpdateModelData.splice(index, 1);

                        })
                        .catch(error => {

                        });
                }
            }
        }
    }
</script>