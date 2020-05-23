<template>
     <div class="content pure-u-1 pure-u-md-1-2">
            <div class="header-medium">

                <div class="items">
                    <h1 class="subhead">Login</h1>

                    <!--<aside class="pure-message message-success">
                        <p><strong>SUCCESS</strong>: Success message.</p>
                    </aside>
                    <aside class="pure-message message-error">
                        <p><strong>ERROR</strong>: Error message.</p>
                    </aside>
                    <aside class="pure-message message-warning">
                        <p><strong>WARNING</strong>: Warning message.</p>
                    </aside>-->
                    <form  class="pure-form pure-form-stacked">
                        <fieldset>

                            <label for="email">Email</label>
                            <input id="email" type="email" placeholder="Email" class="pure-input-1" v-model="credential.email">

                            <label for="password">Password</label>
                            <input id="password" type="password" placeholder="Password" class="pure-input-1" v-model="credential.password">

                            <label for="remember" class="pure-checkbox">
                                <input id="remember" type="checkbox" value="1"> Remember me
                            </label>

                            <a  href="javaScript:void(0)" class="pure-button button-success" @click="login()">Sign in</a>
                        </fieldset>
                    </form>
                </div>

                <div class="footer">
                    <div class="pure-menu pure-menu-horizontal">
                        <ul>
                            <li class="pure-menu-item"><a href="http://purecss.io/" class="pure-menu-link">PURE CSS</a></li>
                            <li class="pure-menu-item"><a href="http://fikiruretgeci.com" class="pure-menu-link">FIKIR URETGECI</a></li>
                            <li class="pure-menu-item"><a href="http://pure-themes.com" class="pure-menu-link">PURE THEMES</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
  import axios from 'axios';
    export default {
        props: {
            msg: String
        },
        data(){
            return{
                credential :{
                    email : '',
                    password:'',
                }
            }
        },
        methods:{
            login(){
                console.log('ami asi eikhane');
                let obj = this;
                this.$eventHandelar.$emit('delayStatus',true);
                axios.post('http://127.0.0.1:8000/api/v1/login/',obj.credential )
                    .then(function (response) {
                        obj.$eventHandelar.$emit('delayStatus',false);
                        if (response.data.error == true){
                            obj.$iziToast.error({
                                title: 'Error',
                                message: 'username or password may be wrong',
                            });
                        }else{
                            console.log(response);
                            localStorage.setItem('token',response.data.token);
                            obj.$eventHandelar.$emit('delayStatus',false);
                            obj.$router.push({path:'/dashboard'})

                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        }

    }
</script>