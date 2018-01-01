<template>
    <div>
        <div class="row">
        
            <div class="col-md-11">
                <div>
                    <div>
                        <button @click="initAddDiscount()" class="btn btn-primary btn-xs pull-right">
                            + Add New Discount
                        </button>
                        <h3><strong>Discount</strong></h3>
                    </div>
                    <div class="alert alert-success" v-if="success.length > 0">
                            <ul>
                                <li v-for="suc in success">{{ suc }}</li>
                            </ul>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="discountUpdateModelData.length > 0">
                            <tbody>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Type
                                </th>
                                <th>
                                    Start Date
                                </th>
                                <th>
                                    End Date
                                </th>
                                <th>
                                    Active
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            <tr v-for="(disc, index) in discountUpdateModelData">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    {{ disc.name }}
                                </td>
                                <td>
                                    {{ disc.type }}
                                </td>
                                <td>
                                    {{ disc.start_date }}
                                </td>
                                <td>
                                    {{ disc.end_date }}
                                </td>
                                <td>
                                    <div v-if="disc.is_active==1">Yes</div>
                                    <div v-if="disc.is_active==0">No</div>
                                    <div v-if="disc.is_active==null">No</div>
                                </td>
                                <td>
                                    <button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button>
                                    <button @click="deleteDiscount(index)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_discount_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Discount</h4>
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
                                   v-model="discountModel.name">
                        </div>
                        <div class="form-group">
                            <label for="description" name="description_id">Description:</label>
                             <textarea name="description" class="form-control" id="description" v-model="discountModel.description" placeholder="Description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="type" name="type">Type:</label>
                            <select id="type" name="type" class="form-control" v-model="discountModel.type">
                                <option value="">Select Type </option>
                                <option value="fix">Fix</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="minimum_amount">Minimum Amount:</label>
                            <input type="text" name="minimum_amount" id="minimum_amount" placeholder="Minimum Amount" class="form-control"
                                   v-model="discountModel.minimum_amount">
                        </div>

                        <div class="form-group">
                            <label for="value">Value:</label>
                            <input type="text" name="value" id="value" placeholder="value" class="form-control"
                                   v-model="discountModel.value">
                        </div>
                        
                         <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type ="date" class="form-control" name="start_date" id="start_date"  v-model="discountModel.start_date">
                        </div>

                         <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type ="date" class="form-control" name="end_date" id="end_date"  v-model="discountModel.end_date">
                        </div>


                        <div class="form-group">
                            <label for="is_active_id">isActive:</label>
                            <input type ="checkbox" name="is_active" id="is_active"  v-model="discountModel.is_active"  value ="1">
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createDiscount" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="update_discount_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Discount</h4>
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
                                   v-model="discountUpdateModel.name">
                        </div>
                        <div class="form-group">
                            <label for="description" name="description_id">Description:</label>
                             <textarea name="description" class="form-control" id="description" v-model="discountUpdateModel.description" placeholder="Description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="type" name="type">Type:</label>
                            <select id="type" name="type" class="form-control" v-model="discountUpdateModel.type">
                                <option value="">Select Type </option>
                                <option value="fix">Fix</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="minimum_amount">Minimum Amount:</label>
                            <input type="text" name="minimum_amount" id="minimum_amount" placeholder="Minimum Amount" class="form-control"
                                   v-model="discountUpdateModel.minimum_amount">
                        </div>

                        <div class="form-group">
                            <label for="value">Value:</label>
                            <input type="text" name="value" id="value" placeholder="Value" class="form-control"
                                   v-model="discountUpdateModel.value">
                        </div>
                        
                         <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type ="date" class="form-control" name="start_date" id="start_date"  v-model="discountUpdateModel.start_date">
                        </div>

                         <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type ="date" class="form-control" name="end_date" id="end_date"  v-model="discountUpdateModel.end_date">
                        </div>


                        <div class="form-group">
                            <label for="is_active_id">isActive:</label>
                            <input type ="checkbox" name="is_active" id="is_active"  v-model="discountUpdateModel.is_active" value ="1">
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateDiscount" class="btn btn-primary">Submit</button>
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
                discountModel: {
                    name: '',
                    description: '',
                    type: '',
                    minimum_amount: '',
                    value: '',
                    start_date: '',
                    end_date: '',
                    is_active: '',
                },//this is for tax creation time set all data null
                errors: [],//errors varidale define as null
                discountUpdateModelData: [],//this varidale define as null when instant changes in table
                discountUpdateModel: {},  //this varidale for get value from the model
                success: [],
                internal: [],
                types: [],

            }
        },
        mounted()
        {
            this.readDiscount();//call when page load
        },
        methods: {
            initAddDiscount()
            {
                
                $("#add_discount_model").modal("show");//show discounts popup when create
            },
            createDiscount()
            {
                //create discounts and axios used to set methods and hit api.
                axios.post('/api/discounts', {
                    name: this.discountModel.name,
                    description: this.discountModel.description,
                    is_active: this.discountModel.is_active,
                    type: this.discountModel.type,
                    minimum_amount: this.discountModel.minimum_amount,
                    value: this.discountModel.value,
                    start_date: this.discountModel.start_date,
                    end_date: this.discountModel.end_date,

                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                        if (response.data.success == true){
                            this.success = [];
                            this.success.push('Discount created successfully!.');
                        this.reset();//reset this value
                        this.discountUpdateModelData.push(response.data.discounts);//assign responce data to the discountUpdateModelData model to fetch data instantly
                        $("#add_discount_model").modal("hide");//hide model
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
                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }

                        if (error.response.data.errors.type) {
                            this.errors.push(error.response.data.errors.type[0]);
                        }
                        if (error.response.data.errors.minimum_amount) {
                            this.errors.push(error.response.data.errors.minimum_amount[0]);
                        }

                        if (error.response.data.errors.value) {
                            this.errors.push(error.response.data.errors.value[0]);
                        }
                        if (error.response.data.errors.start_date) {
                            this.errors.push(error.response.data.errors.start_date[0]);
                        }

                        if (error.response.data.errors.end_date) {
                            this.errors.push(error.response.data.errors.end_date[0]);
                        }

                        if (error.response.data.errors.is_active) {
                            this.errors.push(error.response.data.errors.is_active[0]);
                        }         
                    });
            },
            reset()
            {
                //reset all the vue models data
                this.discountModel.name = '';
                this.discountModel.description = '';
                this.discountModel.available = '';
                this.discountModel.is_active = '';

                this.discountModel.type = '';
                this.discountModel.minimum_amount = '';
                this.discountModel.value = '';

                this.discountModel.start_date = '';
                this.discountModel.end_date = '';

            },
            readDiscount()
            {
                axios.get('/api/discounts')
                    .then(response => {
                        this.discountUpdateModelData = response.data.discounts;
                    });
            },
            initUpdate(index)
            {
                this.errors = [];
                $("#update_discount_model").modal("show");
                this.discountUpdateModel = this.discountUpdateModelData[index];
            },
            updateDiscount()
            {
                axios.patch('/api/discounts/' + this.discountUpdateModel.id, {
                    name: this.discountUpdateModel.name,
                    description: this.discountUpdateModel.description,
                    is_active: this.discountUpdateModel.is_active,
                    type: this.discountUpdateModel.type,
                    minimum_amount: this.discountUpdateModel.minimum_amount,
                    value: this.discountUpdateModel.value,

                    start_date: this.discountUpdateModel.start_date,
                    end_date: this.discountUpdateModel.end_date,
                    

                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                    if (response.data.success == true){
                    this.success = [];
                        this.success.push('Discount updated successfully!.');
                        $("#update_discount_model").modal("hide");//hide model
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
                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }

                        if (error.response.data.errors.type) {
                            this.errors.push(error.response.data.errors.type[0]);
                        }
                        if (error.response.data.errors.minimum_amount) {
                            this.errors.push(error.response.data.errors.minimum_amount[0]);
                        }

                        if (error.response.data.errors.value) {
                            this.errors.push(error.response.data.errors.value[0]);
                        }
                        if (error.response.data.errors.start_date) {
                            this.errors.push(error.response.data.errors.start_date[0]);
                        }

                        if (error.response.data.errors.end_date) {
                            this.errors.push(error.response.data.errors.end_date[0]);
                        }

                        if (error.response.data.errors.is_active) {
                            this.errors.push(error.response.data.errors.is_active[0]);
                        }                        

                    });
            },
            deleteDiscount(index)
            {
                //delete perticular data
                let conf = confirm("Do you ready want to delete this Discount?");
                if (conf === true) {
                    axios.delete('/api/discounts/' + this.discountUpdateModelData[index].id)
                        .then(response => {
                            if (response.data.success == true){
                            this.success = [];
                                this.success.push('Discount deleted successfully!.');
                            }
                            this.discountUpdateModelData.splice(index, 1);

                        })
                        .catch(error => {

                        });
                }
            }
        }
    }
</script>