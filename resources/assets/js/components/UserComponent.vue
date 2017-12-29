<template>
    <div>
        <div class="row">
        
            <div class="col-md-11">
                <div>
                    <div>
                        <button @click="initAddUser()" class="btn btn-primary btn-xs pull-right">
                            + Add New User
                        </button>
                        <h3><strong>Users</strong></h3>
                    </div>
                        <div class="alert alert-success" v-if="success.length > 0">
                            <ul>
                                <li v-for="suc in success">{{ suc }}</li>
                            </ul>
                        </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="userUpdateModelData.length > 0">
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
                            <tr v-for="(customer, index) in userUpdateModelData">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    {{ customer.name }}
                                </td>
                                <td>
                                    {{ customer.mobile }}
                                </td>
                                <td>
                                    <button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button>
                                    <button @click="deleteUser(index)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_user_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New User</h4>
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
                                   v-model="userModel.name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type ="email" name="email" id="email" class="form-control"
                                      placeholder="email" v-model="userModel.email">
                        </div>
                        
                        <div class="form-group">
                            <label for="mobile">Mobile:</label>
                            <input type ="number" name="mobile" id="mobile" class="form-control"
                                      placeholder="Mobile" v-model="userModel.mobile">
                        </div>
                        
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <select name="country" class="form-control" id="country" v-model="userModel.country">
                                <option selected value="">Select Country </option>
                                <option v-for="(cout,name,id) in countries" v-bind:value="cout.id">{{ cout.name }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="role_name">Role Name:</label>
                            <select name="role_name" class="form-control" id="role_name" v-model="userModel.role_name">
                                <option selected value>Select Role Name</option>
                                <option v-for="(role,key,value) in roles" v-bind:value="role.key">{{ role.value }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createCustomers" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="update_user_model">
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
                                   v-model="userUpdateModel.name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type ="email" name="email" id="email" class="form-control"
                                      placeholder="email" v-model="userUpdateModel.email">
                        </div>
                        
                       <div class="form-group">
                            <label for="mobile">Mobile:</label>
                            <input type ="number" name="mobile" id="mobile" class="form-control"
                                      placeholder="Mobile" v-model="userUpdateModel.mobile">
                        </div>
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <select name="country" class="form-control" id="country" v-model="userUpdateModel.country">
                                <option selected value="">Select Country </option>
                                <option v-for="(cout,name,id) in countries" v-bind:value="cout.id">{{ cout.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role_name">Role Name:</label>
                            <select name="role_name" class="form-control" id="role_name" v-model="userUpdateModel.role_name">
                                <option value="">Select Role Name</option>
                                <option v-for="(role,key,value) in roles" v-bind:value="role.key">{{ role.value }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateUser" class="btn btn-primary">Submit</button>
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
                userModel: {
                    name: '',
                    email: '',
                    mobile: '',
                    role_name: '',
                    country: '',
                },//this is for customer creation time set all data null
                errors: [],//errors varidale define as null
                userUpdateModelData: [],//this varidale define as null when instant changes in table
                userUpdateModel: {},//this varidale for get value from the model
                /*roles: [{'key':1,'value':'Admin'},
                    {'key':2,'value': 'Accountant'},
                    {'key':3,'value': 'Store Manager'},
                    {'key':4,'value': 'Cashier'},
                    {'key':5,'value': 'chef'}],*/
                roles : [],
                countries : [],
                success: [],
                internal: [],
            }
        },
        mounted()
        {
            this.readUsers();//call when page load
            axios.get('/api/roles')
                .then(response => {
                    this.roles = response.data.roles
                });
            axios.get('/api/country')
                .then(response => {
                    this.countries = response.data.country
                });
        },
        methods: {
            initAddUser()
            {
                $("#add_user_model").modal("show");//show customers popup when create
            },
            createCustomers()
            {
                //create customer and axios used to set methods and hit api.
                console.log(this.userModel.role_name);
                axios.post('/api/users', {
                    name: this.userModel.name,
                    email: this.userModel.email,
                    mobile: this.userModel.mobile,
                    country: this.userModel.country,
                    role_name: this.userModel.role_name
                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                    if (response.data.success == true){
                        this.success = [];
                        this.success.push('customer created successfully!.');
                        this.reset();//reset this value
                        this.userUpdateModelData.push(response.data.users);//assign responce data to the userUpdateModelData model to fetch data instantly
                        $("#add_user_model").modal("hide");//hide model
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
                        if (error.response.data.errors.email) {
                            this.errors.push(error.response.data.errors.email[0]);
                        }
                        if (error.response.data.errors.mobile) {
                            this.errors.push(error.response.data.errors.mobile[0]);
                        }
                        if (error.response.data.errors.country) {
                            this.errors.push(error.response.data.errors.country[0]);
                        }
                        if (error.response.data.errors.role_name) {
                            this.errors.push(error.response.data.errors.role_name[0]);
                        }
                    });
            },
            reset()
            {
                //reset all the vue models data
                this.userModel.name = '';
                this.userModel.email = '';
                this.userModel.mobile = '';
                this.userModel.country = '';
                this.userModel.role_name = '';
            },
            readUsers()
            {
            //get all the customers list
            //get request using axios
                axios.get('/api/users')
                    .then(response => {
                        this.userUpdateModelData = response.data.users;//asign responce to the userUpdateModelData
                    });
            },
            initUpdate(index)
            {
                //set data for update perticular id
                this.errors = [];
                $("#update_user_model").modal("show");
                this.userUpdateModel = this.userUpdateModelData[index];
            },
            updateUser()
            {
                //send data to the api for update
                axios.put('/api/users/' + this.userUpdateModel.id, {
                    name: this.userUpdateModel.name,
                    email: this.userUpdateModel.email,
                    mobile: this.userUpdateModel.mobile,
                    country: this.userUpdateModel.country,
                    role_name: this.userUpdateModel.role_name,

                })
                    .then(response => {
                    this.errors = [];
                        this.internal = [];
                        if (response.data.success == true){
                        this.success = [];
                            this.success.push('customer updated successfully!.');
                            $("#update_user_model").modal("hide");//hide model
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
                        if (error.response.data.errors.email) {
                            this.errors.push(error.response.data.errors.email[0]);
                        }
                        if (error.response.data.errors.mobile) {
                            this.errors.push(error.response.data.errors.mobile[0]);
                        }
                        if (error.response.data.errors.country) {
                            this.errors.push(error.response.data.errors.country[0]);
                        }
                        if (error.response.data.errors.role_name) {
                            this.errors.push(error.response.data.errors.role_name[0]);
                        }
                    });
            },
            deleteUser(index)
            {
                //delete perticular data
                let conf = confirm("Do you ready want to delete this user?");
                if (conf === true) {
                    axios.delete('/api/users/' + this.userUpdateModelData[index].id)
                        .then(response => {

                            this.userUpdateModelData.splice(index, 1);

                        })
                        .catch(error => {

                        });
                }
            }
        }
    }
</script>