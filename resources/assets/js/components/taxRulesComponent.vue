<template>
    <div>
        <div class="row">
        
            <div class="col-md-11">
                <div>
                    <div>
                        <button @click="initAddTaxes()" class="btn btn-primary btn-xs pull-right">
                            + Add New Tax
                        </button>
                        <h3><strong>Tax</strong></h3>
                    </div>
                    <div class="alert alert-success" v-if="success.length > 0">
                            <ul>
                                <li v-for="suc in success">{{ suc }}</li>
                            </ul>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="taxesUpdateModelData.length > 0">
                            <tbody>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Percentage
                                </th>
                                <th>
                                    Active
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            <tr v-for="(tax, index) in taxesUpdateModelData">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    {{ tax.name }}
                                </td>
                                <td>
                                    {{ tax.percentage }}
                                </td>
                                <td>
                                    <div v-if="tax.is_active==1">Yes</div>
                                    <div v-if="tax.is_active==0">No</div>
                                </td>
                                <td>
                                    <button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button>
                                    <button @click="deleteTaxes(index)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_tax_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Tax</h4>
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
                                   v-model="taxesModel.name">
                        </div>
                        <div class="form-group">
                            <label for="categories_id" name="categories_id">Percentage:</label>
                             
                             <input type="text" name="percentage" id="percentage" placeholder="Percentage" class="form-control"
                                   v-model="taxesModel.percentage">
                        </div>
                        
                        <div class="form-group">
                            <label for="is_active">isActive:</label>
                            <input type ="checkbox" name="is_active" id="is_active"  v-model="taxesModel.is_active">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createTax" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="update_tax_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Tax</h4>
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
                                   v-model="taxesUpdateModel.name">
                        </div>
                        <div class="form-group">
                            <label for="percentage_id" name="percentage_id">Percentage:</label>
                             
                             <input type="text" name="percentage" id="percentage" placeholder="Percentage" class="form-control"
                                   v-model="taxesUpdateModel.percentage">
                        </div>
                        
                        <div class="form-group">
                            <label for="is_active">isActive:</label>
                            <input type ="checkbox" name="is_active" id="is_active"  v-model="taxesUpdateModel.is_active">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateTax" class="btn btn-primary">Submit</button>
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
                taxesModel: {
                    name: '',
                    percentage: '',
                    is_active: '',
                },//this is for tax creation time set all data null
                errors: [],//errors varidale define as null
                taxesUpdateModelData: [],//this varidale define as null when instant changes in table
                taxesUpdateModel: {},  //this varidale for get value from the model
                success: [],
                internal: [],

            }
        },
        mounted()
        {
            this.readTax();//call when page load
        },
        methods: {
            initAddTaxes()
            {
                
                $("#add_tax_model").modal("show");//show tax popup when create
            },
            createTax()
            {
                //create tax and axios used to set methods and hit api.
                axios.post('/api/taxRules', {
                    name: this.taxesModel.name,
                    percentage: this.taxesModel.percentage,
                    is_active: this.taxesModel.is_active,

                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                        if (response.data.success == true){
                            this.success = [];
                            this.success.push('Tax created successfully!.');
                        this.reset();//reset this value
                        this.taxesUpdateModelData.push(response.data.tax);//assign responce data to the taxesUpdateModelData model to fetch data instantly
                        $("#add_tax_model").modal("hide");//hide model
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
                        if (error.response.data.errors.percentage) {
                            this.errors.push(error.response.data.errors.percentage[0]);
                        }
                    });
            },
            reset()
            {
                //reset all the vue models data
                this.taxesModel.name = '';
                this.taxesModel.percentage = '';
                this.taxesModel.available = '';
                this.taxesModel.is_active = '';
            },
            readTax()
            {
                axios.get('/api/taxRules')
                    .then(response => {
                        this.taxesUpdateModelData = response.data.tax;
                    });
            },
            initUpdate(index)
            {
                this.errors = [];
                $("#update_tax_model").modal("show");
                this.taxesUpdateModel = this.taxesUpdateModelData[index];
            },
            updateTax()
            {
                axios.patch('/api/taxRules/' + this.taxesUpdateModel.id, {
                    name: this.taxesUpdateModel.name,
                    percentage: this.taxesUpdateModel.percentage,
                    is_active: this.taxesUpdateModel.is_active,
                    

                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                    if (response.data.success == true){
                    this.success = [];
                        this.success.push('Tax updated successfully!.');
                        $("#update_tax_model").modal("hide");//hide model
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
                        if (error.response.data.errors.percentage) {
                            this.errors.push(error.response.data.errors.percentage[0]);
                        }
                    });
            },
            deleteTaxes(index)
            {
                //delete perticular data
                let conf = confirm("Do you ready want to delete this Tax?");
                if (conf === true) {
                    axios.delete('/api/taxRules/' + this.taxesUpdateModelData[index].id)
                        .then(response => {
                            if (response.data.success == true){
                            this.success = [];
                                this.success.push('Tax deleted successfully!.');
                            }
                            this.taxesUpdateModelData.splice(index, 1);

                        })
                        .catch(error => {

                        });
                }
            }
        }
    }
</script>