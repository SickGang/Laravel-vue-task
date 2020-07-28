<template>
    <div class="container">
        <nav class="row rounded mt-2">
            <div class="col-12 p-3">
                LaravelVueCrud
            </div>
        </nav>
        <departament :departament="departament" ref="depot"></departament>
        <div class="input-group mt-3">
            <input @keyup.enter="saveDepartament()"
                   type="text"
                   class="form-control"
                   v-model="departament.departament_name"
                   placeholder="Название отдела">
            <div class="input-group-append">
                <button @click="saveDepartament"
                        class="btn btn-outline-secondary bg-success text-light"
                        type="button"
                >Сохранить</button>
            </div>
        </div>

    </div>
</template>

<script>
    import departament from './Departament'

    export default {
        data() {
            return {
                departament: {
                    id: '',
                    departament_name: ''
                },
                depot: '',
                edit: false
            }
        },
        methods: {
            saveDepartament() {
                if (this.edit == false) {
                    //Добавление отдела
                    axios.post('/api/departaments', {
                        name: this.departament.departament_name
                    })
                        .then(response => {
                            this.departament.id = ''
                            this.departament.departament_name = ''
                            this.$refs.depot.getDepartaments()
                        })
                        .catch(error =>{
                            console.log(error)
                        })
                        .finally(() => this.loading = false)
                } else {
                    //Редактирование отдела
                    axios.put(`/api/departaments/${this.departament.id}`, {
                        name: this.departament.departament_name
                    })
                        .then(response => {
                            this.departament.id = ''
                            this.departament.departament_name = ''
                            this.$refs.depot.getDepartaments()
                        })
                        .catch(error =>{
                            console.log(error)
                        })
                        .finally(() => this.loading = false)
                }

            }
        },
        components: {departament}
    }
</script>

<style scoped>
    nav {
        background-color: #007bff;
        color: white;
        font-size: 22px;
    }
</style>
