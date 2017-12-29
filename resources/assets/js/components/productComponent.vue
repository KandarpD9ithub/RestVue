<template>
        <div class="row">

            <div class="col-md-11">
                <div>
                    <div>
                        <button @click="initAddProduct()" class="btn btn-primary btn-xs pull-right">
                            + Add New Product
                        </button>
                        <h3><strong>Products</strong></h3>
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
                                        Active
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
                                        {{ product.price }}
                                    </td>
                                    <td>
                                    <div v-if="product.is_active==1">Active</div>
                                    <div v-if="product.is_active==0">InActive</div>
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
                            <label for="category_id" name="category">Category:</label>
                            <select id="category_id" name="categories_id" class="form-control" v-model="productModel.categories_id">
                                <option value="">Select Categorys </option>
                                <option v-for="(cat,id,name) in category" v-bind:value="cat.id"> {{cat.name}} </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sub_category_id" name="sub_cate">Category:</label>
                            <select id="sub_category_id" name="sub_categories_id" class="form-control" v-model="productModel.sub_categories_id">
                                <option value="">Select Sub-Category </option>
                                <option v-for="(subcat,id,name) in subCategory" v-bind:value="subcat.id"> {{subcat.name}} </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tax_id" name="category">Tax:</label>
                            <select id="tax_id" name="tax_id" class="form-control" v-model="productModel.tax_id">
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
                            <h4 class="modal-title">Update Product</h4>
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
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control" v-model="productUpdateModel.name">
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" name="price" id="price" class="form-control" placeholder="Price" v-model="productUpdateModel.price">
                            </div>

                            <div class="form-group">
                                <label for="category_id" name="category">Category:</label>
                                <select id="category_id" name="categories_id" class="form-control" v-model="productUpdateModel.categories_id">
                                    <option value="">Select Category </option>
                                    <option v-for="(category,id,name) in category" v-bind:value="category.id"> {{category.name}} </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sub_category_id" name="category">Sub-Category:</label>
                                <select id="sub_category_id" name="sub_categories_id" class="form-control" v-model="productUpdateModel.sub_categories_id">
                                    <option value="">Select Sub-Category </option>
                                    <option v-for="(subcat,id,name) in subCategory" v-bind:value="subcat.id"> {{subcat.name}} </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tax_id" name="tax_id">Tax:</label>
                                <select id="tax_id" name="tax_id" class="form-control" v-model="productUpdateModel.tax_id">
                                    <option value="">Select Tax </option>
                                    <option v-for="(tax,id,name) in taxes" v-bind:value="tax.id"> {{tax.name}} </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="is_active">isActive:</label>
                                <input type="checkbox" name="is_active" id="is_active" v-model="productUpdateModel.is_active" value="1">
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
                                <button type="button" @click="updateProduct" class="btn btn-primary">Submit</button>
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
                    categories_id: '',
                    sub_categories_id: '',
                    tax_id: '',
                    available: '',
                    description: '',
                    image: '',
                    is_active: '',
                    time_duration: '',
                },
                errors: [],
                prodcutUpdateModelData: [],
                productUpdateModel: {},
                category : [],
                subCategory : [],
                taxes: [],
                success: [],
                internal: [],
            }
        },
        mounted()
        {
        axios.get('/api/products')
                    .then(response => {
                        console.log(response.data.products);
                        this.prodcutUpdateModelData = response.data.products;
                    });
            this.readProducts();
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
                    categories_id: this.productModel.categories_id,
                    sub_categories_id: this.productModel.sub_categories_id,
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
                        if (error.response.data.errors.categories_id) {
                            this.errors.push(error.response.data.errors.categories_id[0]);
                        }
                        if (error.response.data.errors.sub_categories_id) {
                            this.errors.push(error.response.data.errors.sub_categories_id[0]);
                        }
                        if (error.response.data.errors.tax_id) {
                            this.errors.push(error.response.data.errors.tax_id[0]);
                        }
                        if (error.response.data.errors.available) {
                            this.errors.push(error.response.data.errors.available[0]);
                        }
                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }
                        if (error.response.data.errors.image) {
                            this.errors.push(error.response.data.errors.image[0]);
                        }
                        if (error.response.data.errors.is_active) {
                            this.errors.push(error.response.data.errors.is_active[0]);
                        }
                        if (error.response.data.errors.time_duration) {
                            this.errors.push(error.response.data.errors.time_duration[0]);
                        }
                        

                    });
            },
            reset()
            {
                //reset all the vue models data
                this.productModel.name = '';
                this.productModel.price = '';
                this.productModel.categories_id = '';
                this.productModel.sub_categories_id = '';
                this.productModel.tax_id = '';
                this.productModel.available = '';
                this.productModel.description = '';
                this.productModel.image = '';
                this.productModel.is_active = '';
                this.productModel.time_duration = '';

            },
            readProducts()
            {
            axios.get('/api/categoryList')
                .then(response => {
                    this.category = response.data.categoryList;
                });
            axios.get('/api/subCategoryList')
                .then(response => {
                    this.subCategory = response.data.subCategoryList;
                });

            axios.get('/api/taxRules')
                .then(response => {
                    this.taxes = response.data.tax;
                });
                axios.get('/api/products')
                    .then(response => {
                        console.log(response.data.products);
                        this.prodcutUpdateModelData = response.data.products;
                    });
            },
            initUpdate(index)
            {
            
                this.errors = [];
                $("#update_product_model").modal("show");
                console.log(this.prodcutUpdateModelData[index]);
                this.productUpdateModel = this.prodcutUpdateModelData[index];
            },
            updateProduct()
            {
                axios.put('/api/products/' + this.productUpdateModel.id, {
                    name: this.productUpdateModel.name,
                    price: this.productUpdateModel.price,
                    categories_id: this.productUpdateModel.categories_id,
                    sub_categories_id: this.productUpdateModel.sub_categories_id,
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
                        if (error.response.data.errors.categories_id) {
                            this.errors.push(error.response.data.errors.categories_id[0]);
                        }
                        if (error.response.data.errors.sub_categories_id) {
                            this.errors.push(error.response.data.errors.sub_categories_id[0]);
                        }
                        if (error.response.data.errors.tax_id) {
                            this.errors.push(error.response.data.errors.tax_id[0]);
                        }
                        if (error.response.data.errors.available) {
                            this.errors.push(error.response.data.errors.available[0]);
                        }
                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }
                        if (error.response.data.errors.image) {
                            this.errors.push(error.response.data.errors.image[0]);
                        }
                        if (error.response.data.errors.is_active) {
                            this.errors.push(error.response.data.errors.is_active[0]);
                        }
                        if (error.response.data.errors.time_duration) {
                            this.errors.push(error.response.data.errors.time_duration[0]);
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