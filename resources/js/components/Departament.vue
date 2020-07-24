<template>
    <div class="departament-wrap container mt-3">
        <div v-if="loading">
            Идет загрузка...
        </div>
        <div v-else v-for="departament in departaments" :key="departament.id">
            <div class="row departament align-items-center p-2 mt-3">
                <div class="departament-head col-lg-6">
                    {{ departament.departament_name }}
                </div>
                <div class="departament-head_btn col-lg-6 text-right">
                    <button type="button" class="btn btn-primary">Редактировать</button>
                    <button type="button" class="btn btn-danger">Удалить</button>
                </div>
                <departament-worker :departamentId="departament.id"></departament-worker>
                <div class="input-group mt-3">
                    <input type="text" class="form-control" placeholder="Имя сотрудника" aria-label="Название отдела" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-primary text-light" type="button">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import departamentWorker from './DepartamentWorker'
    export default {
        data() {
            return {
                departaments: [],
                departament: {
                    id: '',
                    departament_name: ''
                },
                loading: true
            }
        },
        mounted() {
            this.getDepartaments()
        },
        methods: {
            getDepartaments() {
            axios.get('/api/departaments')
                    .then(response => {
                        this.departaments = response.data
                        console.log(response.data)
                    })
                    .catch(error =>{
                        console.log(error)
                    })
                    .finally(() => this.loading = false)
            }
        },
        components: {departamentWorker}
    }
</script>

<style scoped>
    .departament, .departament-content-wrap, .departament-content {
        border: 1px solid #ced4da;
        border-radius: 0.25rem
    }
</style>
