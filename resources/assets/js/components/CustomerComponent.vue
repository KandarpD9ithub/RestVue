<template>
    <div>
        <div class="row">
        
            <div class="col-md-11">
                <div>
                    <div>
                        <button @click="initAddCustomer()" class="btn btn-primary btn-xs pull-right">
                            + Add New Customer
                        </button>
                        <h3><strong>Customers</strong></h3>
                    </div>
                    <div class="alert alert-success" v-if="success.length > 0">
                            <ul>
                                <li v-for="suc in success">{{ suc }}</li>
                            </ul>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="customerUpdateModelData.length > 0">
                            <tbody>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Mobile Number
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            <tr v-for="(customer, index) in customerUpdateModelData">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    {{ customer.name }}
                                </td>
                                <td>
                                    {{ customer.mobile_number }}
                                </td>
                                <td>
                                    <button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button>
                                    <button @click="deleteCustomer(index)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_customer_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                   v-model="customerModel.name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type ="email" name="email" id="email" class="form-control"
                                      placeholder="email" v-model="customerModel.email">
                        </div>
                        
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number:</label>
                            <input type ="email" name="mobile_number" id="mobile_number" class="form-control"
                                      placeholder="Mobile Number" v-model="customerModel.mobile_number">
                        </div>

                        <div class="form-group">
                            <label for="country">Country:</label>
                            <select name="country" class="form-control" id="country" v-model="customerModel.country">
                                <option selected value="">Select Country </option>
                                <option v-for="(cout,name,id) in countries" v-bind:value="cout.id">{{ cout.name }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="gender">gender:</label>

                            <input type ="radio" name="gender" id="gender"
                                     v-model="customerModel.gender" value="0">Male
                            <input type ="radio" name="gender" id="gender"
                                     v-model="customerModel.gender" value="1">Female
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Birth Date:</label>

                            <input type ="date" name="birth_date" class="form-control" id="birth_date"
                                     v-model="customerModel.birth_date">
                            
                        </div>
                        <div class="form-group">
                            <label for="address">Birth Date:</label>

                            <textarea name="address" id="address" class="form-control" placeholder="Address" v-model="customerModel.address" rows="3"></textarea>
                            
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createCustomers" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="update_customer_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                   v-model="customerUpdateModel.name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type ="email" name="email" id="email" class="form-control"
                                      placeholder="email" v-model="customerUpdateModel.email">
                        </div>
                        
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number:</label>
                            <input type ="email" name="mobile_number" id="mobile_number" class="form-control"
                                      placeholder="Mobile Number" v-model="customerUpdateModel.mobile_number">
                        </div>

                        <div class="form-group">
                            <label for="country">Country:</label>
                            <select name="country" class="form-control" id="country" v-model="customerUpdateModel.country">
                                <option selected value="">Select Country </option>
                                <option v-for="(cout,name,id) in countries" v-bind:value="cout.id">{{ cout.name }}</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="mobile_number">gender:</label>

                            <input type ="radio" name="gender" id="gender"
                                     v-model="customerUpdateModel.gender" value="0">Male
                            <input type ="radio" name="gender" id="gender"
                                     v-model="customerUpdateModel.gender" value="1">Female
                        </div>

                        <div class="form-group">
                            <label for="birth_date">Birth Date:</label>

                            <input type ="date" name="birth_date" class="form-control" id="birth_date"
                                     v-model="customerUpdateModel.birth_date">
                            
                        </div>
                        <div class="form-group">
                            <label for="address">Birth Date:</label>

                            <textarea name="address" id="address" class="form-control" placeholder="Address" v-model="customerUpdateModel.address" rows="3"></textarea>
                            
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateCustomer" class="btn btn-primary">Submit</button>
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
                customerModel: {
                    name: '',
                    email: '',
                    mobile_number: '',
                    gender: '',
                    'birth_date': '',
                    'address': '',
                    country: '',
                },//this is for customer creation time set all data null
                errors: [],//errors varidale define as null
                customerUpdateModelData: [],//this varidale define as null when instant changes in table
                customerUpdateModel: {},  //this varidale for get value from the model
                success: [],
                countries : [],
                internal: [],

            }
        },
        mounted()
        {
        axios.get('/api/country')
                .then(response => {
                    this.countries = response.data.country
                });
            this.readCustomers();//call when page load
        },
        methods: {
            initAddCustomer()
            {
                $("#add_customer_model").modal("show");//show customers popup when create
            },
            createCustomers()
            {
                //create customer and axios used to set methods and hit api.
                axios.post('/api/customers', {
                    name: this.customerModel.name,
                    email: this.customerModel.email,
                    mobile_number: this.customerModel.mobile_number,
                    country: this.customerModel.country,
                    gender: this.customerModel.gender,
                    birth_date: this.customerModel.birth_date,
                    address: this.customerModel.address,

                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                        if (response.data.success == true){
                            this.success = [];
                            this.success.push('customer created successfully!.');
                        this.reset();//reset this value
                        this.customerUpdateModelData.push(response.data.customers);//assign responce data to the customerUpdateModelData model to fetch data instantly
                        $("#add_customer_model").modal("hide");//hide model
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
                        /*if (error.response.data.errors.email) {
                            this.errors.push(error.response.data.errors.email[0]);
                        }*/
                        if (error.response.data.errors.mobile_number) {
                            this.errors.push(error.response.data.errors.mobile_number[0]);
                        }
                        /*
                        if (error.response.data.errors.country) {
                            this.errors.push(error.response.data.errors.country[0]);
                        }
                        if (error.response.data.errors.gender) {
                            this.errors.push(error.response.data.errors.gender[0]);
                        }
                        */
                    });
            },
            reset()
            {
                //reset all the vue models data
                this.customerModel.name = '';
                this.customerModel.email = '';
                this.customerModel.mobile_number = '';
                this.customerModel.country = '';
                this.customerModel.gender = '';
                this.customerModel.birth_date = '';
                this.customerModel.address = '';
            },
            readCustomers()
            {
            //get all the customers list
            //get request using axios
                axios.get('/api/customers')
                    .then(response => {
                        this.customerUpdateModelData = response.data.customers;//asign responce to the customerUpdateModelData
                    });
            },
            initUpdate(index)
            {
                //set data for update perticular id
                this.errors = [];
                $("#update_customer_model").modal("show");
                this.customerUpdateModel = this.customerUpdateModelData[index];
            },
            updateCustomer()
            {
            
                //send data to the api for update
                axios.patch('/api/customers/' + this.customerUpdateModel.id, {
                    name: this.customerUpdateModel.name,
                    email: this.customerUpdateModel.email,
                    mobile_number: this.customerUpdateModel.mobile_number,
                    country: this.customerUpdateModel.country,
                    gender: this.customerUpdateModel.gender,
                    birth_date: this.customerUpdateModel.birth_date,
                    address: this.customerUpdateModel.address,
                    

                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                    if (response.data.success == true){
                    this.success = [];
                        this.success.push('customer updated successfully!.');
                        $("#update_customer_model").modal("hide");//hide model
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
                        /*if (error.response.data.errors.email) {
                            this.errors.push(error.response.data.errors.email[0]);
                        }*/
                        if (error.response.data.errors.mobile_number) {
                            this.errors.push(error.response.data.errors.mobile_number[0]);
                        }
                        /*if (error.response.data.errors.country) {
                            this.errors.push(error.response.data.errors.country[0]);
                        }
                        if (error.response.data.errors.gender) {
                            this.errors.push(error.response.data.errors.gender[0]);
                        }
                        */
                        
                    });
            },
            deleteCustomer(index)
            {
                //delete perticular data
                let conf = confirm("Do you ready want to delete this customer?");
                if (conf === true) {
                    axios.delete('/api/customers/' + this.customerUpdateModelData[index].id)
                        .then(response => {
                            if (response.data.success == true){
                            this.success = [];
                                this.success.push('customer deleted successfully!.');
                            }
                            this.customerUpdateModelData.splice(index, 1);

                        })
                        .catch(error => {

                        });
                }
            }
        }
    }
</script>