<template>
<div class="row">
    <div class="col-sm-md-12">
        <div class="col-sm-md-6">
        <div class="alert alert-danger" v-if="errors.length > 0">
                                <ul>
                                    <li v-for="error in errors">{{ error }}</li>
                                </ul>
                            </div>
                            <div class="alert alert-success" v-if="success.length > 0">
                                <ul>
                                    <li v-for="suc in success">{{ suc }}</li>
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

        <div class="col-sm-6">
        
            <div>
            <div class="col-sm-6 row">
                <div class="col-md-2">
                    <h4 class="modal-title">Category</h4>
                </div>
                <div v-for="cat in categoriesModel" class="col-sm-12">
                <button for="sub_category_id" name="sub_categories_id" v-bind:value="cat.id" @click="addSubCategoryCart(cat.id)"class="form-control btn btn-group">{{ cat.name }}</button>
                </div>
                <hr>
                <div class="col-sm-6">
                    <h4 class="modal-title">Sub-Category</h4>
                </div>
                <div v-for="subcat in subCategoriesModel" class="col-sm-12">
                <button for="category_id" name="categories_id" v-bind:value="subcat.id" @click="addSubCatProductCart(subcat.id)"class="form-control btn btn-group">{{ subcat.name }}</button>
                </div>
            </div>
            <div class="col-sm-6 row">
                <div class="col-md-2">
                    <h4 class="modal-title">Products</h4>
                </div>
                <div v-for="product in productModel" class="col-sm-12">
                <button for="product_id" name="product_id" v-bind:value="product.id" @click="addProductCart(product.id) "class="form-control btn btn-group">{{ product.name }}</button>
                </div>
            </div>
            </div>
        </div>
            
    </div>


    <div class="col-sm-md-12 scroll">
        <div class="col-sm-md-6">
            <div class="panel-footer" v-if="productSelect.length" v-for="(elsefor,index) in productSelect">
                    <li class="list-group-item">
                     <div class="col-sm-6">
                            <label>{{ elsefor.name }} X {{ elsefor.quantity }}  X {{elsefor.price}}</label>
                     </div>
                     <div class="col-sm-md-2">
                            <label class="red"> {{ elsefor.quantity * elsefor.price }}</label>

                            <input type="button" @click="addProductCart(elsefor.id)" value="+"> {{ elsefor.quantity }} <input type="button"  value="-" @click="removeProductCartQuantity(elsefor.id,index)">

                             <button @click="removeProduct(index)" class="close_btn">X</button>
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
            <input type="checkbox" name="parcel" value="1" v-model="orderModel.parcel">Parcel
            </div>
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

                                <div class="col-md-3">
                                    Order Number:-
                                </div>
                                <div class="col-sm-md-3">
                                    {{ this.order_number }}
                                </div>


                                <div class="col-md-3">
                                    Date:-
                                </div>
                                <div class="col-sm-md-3">
                                    {{ this.date }}
                                </div>


                                <hr>

                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <b> Items </b>
                                    </div>
                                    <div class="col-md-3">
                                        <b> Price </b>
                                    </div>
                                    <div class="col-md-3">
                                        <b> Qnty. </b>
                                    </div>
                                    <div class="col-md-3">
                                        <b> s.total. </b>
                                    </div>
                                    <div class="col-md-12"  v-if="productSelect.length" v-for="(elsefor,index) in productSelect">
                                        <div class="col-md-3">
                                             {{ elsefor.name }} 
                                        </div>
                                        <div class="col-md-3">
                                         {{ elsefor.price }}
                                        </div>
                                        <div class="col-md-3">
                                         {{ elsefor.quantity }} 
                                        </div>
                                        <div class="col-md-3">
                                         {{ elsefor.price * elsefor.quantity }} 
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
                            <hr>
                                <div class="col-sm-md-2">
                                    <input type="submit" name="print" class="form-control" value="Print">
                                </div>
                                <div class="col-sm-md-2">
                                    <input type="button" name="print" @click="Cancel" class="form-control" value="Cancel" data-dismiss="modal">
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
                    parcel: '',
                },
                errors: [],
                success: [],
                internal: [],
                productModel: [],
                categoriesModel: [],
                subCategoriesModel: [],
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
                auth_id: localStorage.getItem('auth_id'),
                order_number: '',
                date: '',
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
                    if(this.orderModel.parcel == ''){
                        this.orderModel.parcel = false;
                    }
                axios.post('/api/orders', {

                    customer_id: this.orderModel.order_customer,
                    auth_id: this.auth_id,
                    products: this.productSelect,
                    parcel: this.orderModel.parcel,
                    sub_total: this.total,
                    grand_total: this.grand_total,
                    tax: this.tax,
                    discount: this.discount,


                })
                    .then(response => {
                    this.errors = [];
                    this.internal = [];
                        if (response.data.success == true){
                            this.success = [];
                            this.success.push(response.data.message);   
                        }
                        this.date = response.data.orderDetails.ordered_at;
                        this.order_number = response.data.orderDetails.order_number;

                    })
                    .catch(error => {
                        //error handling
                        this.errors = []
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
                axios.get('/api/category')
                    .then(response => {
                        this.categoriesModel = response.data.categories;
                    });
                axios.get('/api/subCategory')
                    .then(response => {
                        this.subCategoriesModel = response.data.subCategories;
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
                        
                        if(this.productSelect.length >0){
                            let i = this.productSelect.map(item => item.id).indexOf(id)
                            if(this.productSelect[i]){
                                if(id == this.productSelect[i].id){
                                console.log(this.productSelect)
                                    this.productSelect[i].quantity = this.productSelect[i].quantity+1;
                                    this.calculation(response.data.products);
                                }else{
                                    this.productSelect.push(response.data.products);
                                    this.calculation(response.data.products);
                                }
                            }
                            else{
                                this.productSelect.push(response.data.products);
                                this.calculation(response.data.products);
                            }
                        }else{
                            this.productSelect.push(response.data.products);
                            this.calculation(response.data.products);
                        }

                    })

                this.searchProduct = [];
                this.orderModel.search_product = '';
           },
           removeProduct(index) {
           console.log(index);
                this.productSelect.splice(index,1);
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
                    this.total += datas[i].price * datas[i].quantity;
                    var tax_total = datas[i].price * datas[i].quantity * datas[i].tax_id /100;
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
                    this.createOrder();
                    $("#invoice_model").modal("show");
                }
           },
           Cancel() {
                this.productSelect = [];
                this.customerSelect = [];
                this.tax = '';
                this.total= '';
                this.grand_total= '';
                this.discount= '';
                this.reset();
           },
           addSubCategoryCart(id) {
                axios.get('/api/subCategoryList/'+id)
                .then(response => {
                    this.subCategoriesModel = [];
                    this.subCategoriesModel = response.data.subCategoryList;
                });
                axios.get('/api/catProductList/'+id)//product by sub category
                .then(response => {
                this.productModel = [];
                    this.productModel = response.data.catProductList;
                });
           },
           addSubCatProductCart(id) {
                axios.get('/api/subProductList/'+id)//product by sub category
                .then(response => {
                this.productModel = [];
                    this.productModel = response.data.subProductList;
                });
           },
           removeProductCartQuantity(id,index) {
                    if(this.productSelect.length >0){
                            let i = this.productSelect.map(item => item.id).indexOf(id)
                            if(this.productSelect[i]){
                                    if(id == this.productSelect[i].id){
                                        this.productSelect[i].quantity = this.productSelect[i].quantity-1;
                                        console.log(this.productSelect);
                                        this.calculationDec(this.productSelect);
                                    }
                                    if(this.productSelect[i].quantity == 0){
                                        this.removeProduct(index);
                                    }
                                
                            }
                    }
                    
           }

        
        }
    }
</script>