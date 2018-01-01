<template>
    <div>
        <div class="row">
        
            <div class="col-md-11">
                <div>
                    <div>
                        <button @click="initAddTables()" class="btn btn-primary btn-xs pull-right">
                            + Add New Tables
                        </button>
                        <h3><strong>Tables</strong></h3>
                    </div>
                    <div class="alert alert-success" v-if="success.length > 0">
                            <ul>
                                <li v-for="suc in success">{{ suc }}</li>
                            </ul>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="tablesUpdateModelData.length > 0">
                            <tbody>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Table No.
                                </th>
                                <th>
                                    Active
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            <tr v-for="(disc, index) in tablesUpdateModelData">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    {{ disc.name }}
                                </td>
                                <td>
                                    <div v-if="disc.is_active==1">Yes</div>
                                    <div v-if="disc.is_active==0">No</div>
                                    <div v-if="disc.is_active==null">No</div>
                                </td>
                                <td>
                                    <button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button>
                                    <button @click="deleteTables(index)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_tables_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Tables</h4>
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
                                   v-model="tablesModel.name">
                        </div>

                        <div class="form-group">
                            <label for="is_active_id">isActive:</label>
                            <input type ="checkbox" name="is_active" id="is_active"  v-model="tablesModel.is_active"  value ="1">
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createTables" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="update_tables_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Tables</h4>
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
                                   v-model="tablesUpdateModel.name">
                        </div>


                        <div class="form-group">
                            <label for="is_active_id">isActive:</label>
                            <input type ="checkbox" name="is_active" id="is_active"  v-model="tablesUpdateModel.is_active" value ="1">
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateTables" class="btn btn-primary">Submit</button>
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
                tablesModel: {
                    name: '',
                    is_active: '',
                },//this is for tax creation time set all data null
                errors: [],//errors varidale define as null
                tablesUpdateModelData: [],//this varidale define as null when instant changes in table
                tablesUpdateModel: {},  //this varidale for get value from the model
                success: [],
                internal: [],
                types: [],

            }
        },
        mounted()
        {
            this.readTables();//call when page load
        },
        methods: {
            initAddTables()
            {
                
                $("#add_tables_model").modal("show");//show tables popup when create
            },
            createTables()
            {
                //create tables and axios used to set methods and hit api.
                axios.post('/api/tables', {
                    name: this.tablesModel.name,
                    is_active: this.tablesModel.is_active,

                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                        if (response.data.success == true){
                            this.success = [];
                            this.success.push('Table created successfully!.');
                        this.reset();//reset this value
                        this.tablesUpdateModelData.push(response.data.tables);//assign responce data to the tablesUpdateModelData model to fetch data instantly
                        $("#add_tables_model").modal("hide");//hide model
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
                        if (error.response.data.errors.is_active) {
                            this.errors.push(error.response.data.errors.is_active[0]);
                        }         
                    });
            },
            reset()
            {
                //reset all the vue models data
                this.tablesModel.name = '';
                this.tablesModel.is_active = '';
            },
            readTables()
            {
                axios.get('/api/tables')
                    .then(response => {
                        this.tablesUpdateModelData = response.data.tables;
                    });
            },
            initUpdate(index)
            {
                this.errors = [];
                $("#update_tables_model").modal("show");
                this.tablesUpdateModel = this.tablesUpdateModelData[index];
            },
            updateTables()
            {
                axios.patch('/api/tables/' + this.tablesUpdateModel.id, {
                    name: this.tablesUpdateModel.name,
                    is_active: this.tablesUpdateModel.is_active,
                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                    if (response.data.success == true){
                    this.success = [];
                        this.success.push('Table updated successfully!.');
                        $("#update_tables_model").modal("hide");//hide model
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
                        if (error.response.data.errors.is_active) {
                            this.errors.push(error.response.data.errors.is_active[0]);
                        }                        

                    });
            },
            deleteTables(index)
            {
                //delete perticular data
                let conf = confirm("Do you ready want to delete this Table?");
                if (conf === true) {
                    axios.delete('/api/tables/' + this.tablesUpdateModelData[index].id)
                        .then(response => {
                            if (response.data.success == true){
                            this.success = [];
                                this.success.push('Table deleted successfully!.');
                            }
                            this.tablesUpdateModelData.splice(index, 1);

                        })
                        .catch(error => {

                        });
                }
            }
        }
    }
</script>