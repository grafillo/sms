<template>
    <div class="text-center">

        <template v-if="unregisteredUser">
        Имя<br>
        <input type='text' v-model="name"  name='text'><br>
        телефон<br>
        <input type='text' v-model="phone"  name='text'><br>
        Password<br>
        <input type='password' v-model="password" name='text'><br>
        Подтвердите Password<br>
        <input type='password' v-model="password_confirmation" name='text'><br>
        <input type='submit'  @click.prevent="register" value='Зарегистрироваться' class='mt-3 btn btn-success'>
        </template>

        <template v-if="unconfirmPhone">
           На ваш телефон {{ this.phone}} должен поступить звонок, введите последние 4 цифры звонившего телефона
            <input type='text' v-model="confirmNumber" name='text'><br>
            <input type='submit'  @click.prevent="confirmPhone" value='Подтвердить телефон' class='mt-3 btn btn-success'>
        </template>


        <h5 class="text-danger text-center" v-if="errors" v-for="error in errors">
            {{error[0]}}
        </h5>
    </div>



</template>

<script>

export default {

    name: "RegisterationComponent",


    data(){
        return{
            unregisteredUser: true,
            unconfirmPhone: false,
            confirmNumber: null,
            phone: null,
            errors: null,
            name: null,
            email: null,
            password: null,
            password_confirmation: null,

        }

    },
    methods:{

        register(){
            axios.get('sanctum/csrf-cookie').then(response => {


                axios.post('api/register',{password:this.password,password_confirmation:this.password_confirmation,name:this.name,phone:this.phone})
                    .then(
                        res => {
                            this.$parent.$parent.title = 'Регистрация'
                            this.unregisteredUser = false
                            this.unconfirmPhone = true
                            this.errors = null;

                            console.log(res);

                        }
                    )
                    .catch(error => {

                        this.errors = error.response.data.errors
                    })

            })

            },

        confirmPhone(){
            axios.get('sanctum/csrf-cookie').then(response => {


                axios.post('api/confirm',{phone:this.phone,confirmNumber:this.confirmNumber})
                    .then(
                        res => {

                            console.log(res);
                            // sessionStorage.setItem("phone",  JSON.parse(res.config.data).phone);
                            this.$router.push({name:'index'})
                        }
                    )
                    .catch(error => {

                        this.errors = error.response.data.errors
                    })

            })

        }



    },

    mounted(){
        this.$parent.$parent.title = 'Регистрация'

    }
}
</script>

<style scoped>

</style>
