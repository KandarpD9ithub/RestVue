<template>
    <div>
        <div>
            <div>
                <div>

                    <div >
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
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="email" id="email" v-model="model.email"/>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password" v-model="model.password"/>
        </div>
        <div class="form-actions">
            <input type="submit" value="Submit" class="btn btn-success uppercase" @click="login">
            <label class="rememberme check">
            <input type="checkbox" name="remember" value="1"/>Remember </label>
            <a href="javascript:;" id="forget-password" onclick="showForm('forgot')" class="forget-password">Forgot Password?</a>
        </div>     
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data (){
            return {
                model:{

                    email: '',
                    password: '',
                },
                errors: [],
                success: [],
                internal: [],

            }
        },
        methods: {
                
                login() {
                    axios.post('/api/Login', {
                        email: this.model.email,
                        password: this.model.password,
                    })
                    .then(response => {
                    console.log(response);
                    if(response.data.success == true){
                        let auth_id = response.data.auth_id;
                        if(auth_id){
                            localStorage.setItem('auth_id',auth_id);
                        }
                        console.log(auth_id);
                        window.location.href = '/home';
                    }
                    if(response.data.success == false){
                        this.errors = [];
                            this.errors.push(response.data.message);
                    }
                })
                .catch(error => {
                console.log('error');
                        //error handling
                        this.errors = [];
                        if (error.response.data.errors.email) {
                            this.errors.push(error.response.data.errors.email[0]);
                        }
                        if (error.response.data.errors.password) {
                            this.errors.push(error.response.data.errors.password[0]);
                        }
                })
           }
        }
    }
</script>
