<template>
    <div class="bg-info row pt-5">
        <div class="col-md-6">
            <div class="">
                <div class="col-md-10 m-auto">
                    <div class="body-text">
                        <img src="assets/img/favicon.png" alt="">
                        <h1>Register For Flying Chat</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-8">
                <section class="form-style" style="background: #FFFFFF" >
                    <div class="card card-body mb-5">
                        <span class="shape2"></span>
                        <form v-on:submit.prevent="submit" class="singup-form">
                            <div class="form-group">
                                <input type="text"
                                       v-model="data.name"
                                       :class="{ 'is-invalid': validation.hasError('data.name'), 'is-valid': data.name }"
                                       name="name"
                                       placeholder="Name"
                                >
                                <div class="invalid-feedback">{{ validation.firstError('data.name') }}</div>
                            </div>
                            <div class="form-group">
                                <input type="text"
                                       v-model="data.username"
                                       name="username"
                                       placeholder="Username"
                                       :class="{ 'is-invalid': validation.hasError('data.username'), 'is-valid': data.username }"

                                >
                                <div class="invalid-feedback">{{ validation.firstError('data.username') }}</div>
                            </div>
                            <div class="form-group">
                                <input type="text"
                                       v-model="data.email"
                                       name="login_email"
                                       placeholder="Email"
                                       :class="{ 'is-invalid': validation.hasError('data.email'), 'is-valid': data.email }"
                                >
                                <div class="invalid-feedback">{{ validation.firstError('data.email') }}</div>
                            </div>
                            <div class="form-group">
                                <input type="password"
                                       v-model="data.password"
                                       name="login_password"
                                       placeholder="Password"
                                       :class="{ 'is-invalid': validation.hasError('data.password'), 'is-valid': data.password }"
                                >
                                <div class="invalid-feedback">{{ validation.firstError('data.password') }}</div>
                            </div>
                            <div class="form-group mt-4 row">
                                <button class="btn btn-outline-success ml-3 col-md-5">Submit</button>
                            </div>
                        </form>
                        <router-link to="/login">Already have an account!</router-link>
                    </div>
                </section>
            </div>
        </div>
    </div>

</template>

<script>
    import router from '../Routes'
    import Vue from 'vue';
    import SimpleVueValidation from 'simple-vue-validator';
    const Validator = SimpleVueValidation.Validator;
    Vue.use(SimpleVueValidation);
    export default {
        name: "RegisterComponent",
        data(){
            return{
                data:{},
            };
        },

        methods: {
            submit: function(e) {
                this.$validate().then(res => {
                    if (res) {
                        axios.post('/register-data',this.data)
                        .then(response =>{
                            if (response.status == 200){
                                router.push({ name: 'HomeComponent' })
                            }

                        })
                        .cache(error =>{
                            console.log(error);
                        })
                    }
                })
            }
        },
        mounted(){

        },
        validators: {
            'data.name': function (value = null) {
                return Validator.value(value).required('Name is required');
            },
            'data.username': function (value = null) {
                return Validator.value(value)
                    .required('Username is required')
                    .minLength(4);
            },
            'data.email': function (value = null) {
                return Validator.value(value)
                    .required('Email is required')
                    .email();
            },
            'data.password': function (value = null) {
                return Validator.value(value)
                    .required('Password is required')
                    .minLength(6);
            },
        }
    }
</script>

<style scoped>
    .card-right-body{
        background: #1b4b72;
    }
    .singup-form {
        position: relative;
        z-index: 2;
        color: #fff;
        height: 480px;
    }
    .form-style .card .shape2 {
        width: 409px;
        height: 552px;
        background: #31ffe8;
        opacity: .2;
        position: absolute;
        top: 33px;
        left: -240px;
        border-radius: 57px;
        -webkit-transform: rotate(30deg);
        transform: rotate(45deg);
    }
    .singup-form[data-v-4d2414bf][data-v-4d2414bf] {
        position: relative;
        z-index: 2;
        color: #fff;
        height: 427px;
        margin-top: 67px;
    }
    .body-text {
        font-size: 40px;
        margin: 177px 50px;
        font-family: cursive;
        color: chocolate;
        font-style: oblique;
    }
    .bg-info {
        background-color: #343a40 !important;
    }
    .body-text img {
        height: 39px;
        width: 91px;
        margin: 0px 113px;
    }
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(187, 187, 187, 0.125);
        border-radius: -1.75rem;
        box-shadow: 0px 0px 0px 0px;
        overflow: hidden;
    }
</style>
