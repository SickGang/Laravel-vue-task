<template>
    <div v-if="loading">
        Идет загрузка...
    </div>
    <div class="col-12 departament-content-wrap mt-2" v-else>
        <div class="departament-content row align-items-center p-2"
        v-for="worker in workers"
        :key="worker.id"
        >
            <div class="departament-content_head col-lg-6">
                {{ worker.worker_name }}
            </div>
            <div class="departament-content_btn col-lg-6 text-right">
                <button type="button" class="btn btn-primary">Редактировать</button>
                <button type="button" class="btn btn-danger">Удалить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['departamentId'],
        data() {
            return {
                workers: [],
                worker: {
                    id: '',
                    worker_name: '',
                    departamentd_id: ''
                },
                loading: true
            }
        },
        mounted() {
            this.getWorkers()
        },
        methods: {
            getWorkers() {
                    axios.get('/api/departaments', {
                        params: {
                            workerId: this.departamentId
                        }
                    })
                        .then(response => {
                            this.workers = response.data
                            console.log(this.workers)
                        })
                        .catch(error =>{
                            console.log(error)
                        })
                        .finally(() => this.loading = false)
            }
        }
    }
</script>

<style scoped>
    .departament-content {
        border: 1px solid #ced4da;
        border-radius: 0.25rem
    }
</style>
