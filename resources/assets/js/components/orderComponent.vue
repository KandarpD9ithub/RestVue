<template>
<div class="row">
    <div class="col-sm-md-12">
        <div class="col-sm-md-6">
        <div class="alert alert-danger" v-if="errors.length > 0">
                                <ul>
                                    <li v-for="error in errors">{{ error }}</li>
                                </ul>
                            </div>
            <div class="col-md-3">
                <div class="form-group">

                    <input type="text" name="search_product" id="search_product" v-model="orderModel.search_product" v-on:keyup="autoComplete" class="form-control" placeholder="Search Product">
                        <div class="panel-footer" v-if="searchProduct.length">
                           <ul class="list-group">
                                <li class="list-group-item" v-for="result in searchProduct" @click="addProductCart(result.id)">
                                 {{ result.name }}
                                </li>
                           </ul>
                        </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="search_customer" id="search_customer" v-model="orderModel.search_customer" class="form-control" placeholder="Search Customer" v-on:keyup="autoCompleteCustomer">
                    <div class="panel-footer" v-if="searchCustomer.length">
                           <ul class="list-group">
                                <li class="list-group-item" v-for="customer in searchCustomer" @click="addCustomer(customer.id)">
                                 {{ customer.name }}
                                </li>
                           </ul>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-sm-md-6">
        <div class="col-md-2">
        <h4 class="modal-title">Products</h4>
        </div>
            <div v-for="product in productModel">
            <div class="col-md-2">
                <button for="sub_category_id" name="sub_categories_id" v-bind:value="product.id" @click="addProductCart(product.id)"class="form-control">{{ product.name }}</button>
                
            </div>
            </div>
        </div>
            
    </div>


    <div class="col-sm-md-12 scroll">
        <div class="col-sm-md-6">
            <div class="panel-footer" v-if="productSelect.length" v-for="(elsefor,index) in productSelect">
                    <li class="list-group-item">
                     <div class="col-sm-md-4">
                            <label>{{ elsefor.name }}</label>
                     </div>
                     <div class="col-sm-md-2">
                            <label class="red"> {{ elsefor.price }}</label> <button @click="removeProduct(index)" class="close_btn">X</button>
                      </div>
                    </li>
            </div>
        </div>
    </div>
        <div class="col-md-6">
            <b>
                Sub-Total   :- &#8377{{ this.total }}<br>
                Tax (CGST: 2.50%, SGST: 2.50%) GST         :-  &#8377{{ this.tax }}<br>
                Discount    :- &#8377{{ this.discount }}<br>
                Grand-Total :- &#8377{{ this.grand_total }}<br>
            </b>
        </div>
        <div class="col-md-6">
            <div class="col-md-3">
            <input type="submit" name="checkout" @click="checkOut" class="form-control" value="Check-Out">
            </div>
        </div>


            <div class="modal fade" tabindex="-1" role="dialog" id="invoice_model">
            <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Invoice</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-md-12">
                                <div class="col-md-3">
                                    Customer Name:-
                                </div>
                                <div class="col-sm-md-3">
                                    {{ this.orderModel.search_customer }}
                                </div>

                                <hr>

                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <b> Items </b>
                                    </div>
                                    <div class="col-md-6">
                                        <b> Price </b>
                                    </div>
                                    <div class="col-md-12"  v-if="productSelect.length" v-for="(elsefor,index) in productSelect">
                                        <div class="col-md-4">
                                             {{ elsefor.name }} 
                                        </div>
                                        <div class="col-md-6">
                                         {{ elsefor.price }}
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-12"
                                <div class="col-md-4">
                                    Sub-Total:-
                                </div>
                                <div class="col-sm-md-6">
                                    <b> &#8377 {{ this.total }} </b>
                                </div>

                                <div class="col-md-4">
                                    Tax:-
                                </div>
                                <div class="col-sm-md-6">
                                    <b> &#8377 {{ this.tax }} </b>
                                </div>

                                <div class="col-md-4">
                                    Discount:-
                                </div>
                                <div class="col-sm-md-6">
                                    <b> &#8377 {{ this.discount }} </b>
                                </div>

                                <div class="col-md-4">
                                    Gand-Total:-
                                </div>
                                <div class="col-sm-md-6">
                                    <b> &#8377 {{ this.grand_total }} </b>
                                </div>
                            </div>


                            </div>
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
                orderModel: {
                    search_customer: '',
                    search_product: '',
                    order_customer: '',
                },
                errors: [],
                success: [],
                internal: [],
                productModel: [],
                searchProduct: [],
                results: [],
                resultsCustomer: [],
                productSelect: [],
                customerSelect: [],
                searchCustomer: [],
                total: 0,
                sub_total: 0,
                grand_total: 0,
                tax: 0,
                discount: 0,
            }
        },
        mounted()
        {
            this.readOrder();//call when page load
        },
        methods: {
            initAddOrder()
            {
                alert('fgh');
            },
            createOrder()
            {
                axios.post('/api/orders', {

                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                        if (response.data.success == true){
                            this.success = [];
                            this.success.push('Tax created successfully!.');
                        this.reset();//reset this value
                        this.taxesUpdateModelData.push(response.data.tax);//assign response data to the taxesUpdateModelData model to fetch data instantly
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
                this.orderModel.search_customer = '';
                this.orderModel.ssearch_product = '';
            },
            readOrder()
            {
                axios.get('/api/products')
                    .then(response => {
                        this.productModel = response.data.products;
                    });
            },
            autoComplete(){
                this.results = [];
                if(this.orderModel.search_product.length > 0){
                     axios.get('/api/search',{params: {query: this.orderModel.search_product}}).then(response => {
                      this.searchProduct = response.data;
                     });
                }
           },
           addProductCart(id){
                axios.get('/api/getProduct/'+id)
                    .then(response => {
                        this.calculation(response.data.products[0]);
                        this.productSelect.push(response.data.products[0]);
                    })
                this.searchProduct = [];
                this.orderModel.search_product = '';
           },
           removeProduct(id) {
                this.productSelect.splice(id,1);
                this.calculationDec(this.productSelect);
           },
           autoCompleteCustomer() {
                 this.resultsCustomer = [];
                if(this.orderModel.search_customer.length > 0){
                     axios.get('/api/searchCustomer',{params: {query: this.orderModel.search_customer}}).then(response => {
                      this.searchCustomer = response.data;
                     });
                }
           },
           addCustomer(id){
                axios.get('/api/getCustomer/'+id)
                    .then(response => {
                        this.customerSelect.push(response.data.customer);
                    this.orderModel.search_customer = response.data.customer[0].name;
                    this.orderModel.order_customer = response.data.customer[0].id;
                    this.searchCustomer = [];
                    })
           },
           calculation(data) {
                    this.total += data.price * 1;
                    var tax_total = data.price * data.tax_id /100;
                    this.tax += tax_total *1;
                    this.grand_total = this.total+this.tax;
           },
           calculationDec(datas) {
            this.total = 0;
            this.tax = 0;
            this.grand_total = 0;
                for(var i=0; i< datas.length; i++){
                    this.total += datas[i].price * 1;
                    var tax_total = datas[i].price * datas[i].tax_id /100;
                    this.tax += tax_total *1;
                    this.grand_total = this.total+this.tax;
                }
           },
           checkOut(){
           this.errors = [];
                if(this.productSelect.length == 0){
                    this.errors.push('please select product');
                }
                if(this.customerSelect.length == 0){
                    this.errors.push('please select Customer');
                }
                if(this.customerSelect.length > 0 && this.productSelect.length > 0){
                    $("#invoice_model").modal("show");
                }
           }

        
        }
    }
</script>