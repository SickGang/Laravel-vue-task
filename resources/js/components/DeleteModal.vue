<template>
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Удаление</h5>
                </div>
                <div class="modal-body">
                    <p>Вы точно хотите удалить: {{depat.departament_name}} {{depat.worker_name}}? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                            @click="deleteDepartament">
                            Удалить</button>
                    <button
                            @click="$emit('close')"
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                            Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import departamentworker from './DepartamentWorker.vue'

    export default {
        props: ['depat'],
        data() {
          return {
              departament: null
          }
        },
        methods: {
          deleteDepartament() {
            this.departament = this.depat
            if (this.departament.departament_name) {
              this.$emit('deleteDep', this.departament.id)
            } else {
              this.$parent.$children[0].deleteWorker(this.departament.id)
            }
          }
        },
        components: {departamentworker}
    }
</script>

<style scoped>
    .modal {
        top: 35%;
        display: block;
    }
</style>
