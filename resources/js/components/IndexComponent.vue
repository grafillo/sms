<template>
    <div class="text-center">
        Вы успешно зарегистрировались!<br>
        <input type='submit'  @click.prevent="exit" value='Выйти' class='mt-3 btn btn-success'>
    </div>


</template>

<script>
export default {

    name: "IndexComponent",

    data(){
        return{

        }

    },
    methods:{

        exit(){
            axios.get('sanctum/csrf-cookie').then(response => {


                axios.post('api/logout',{})
                    .then(
                        res => {
                            this.$router.push({name:'registration'})
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
