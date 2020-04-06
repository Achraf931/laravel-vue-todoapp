<template>
    <div class="update">
        <h1>Update Task</h1>
        <textarea v-bind:class="{error: !$v.content.required}" type="text" v-model.trim="$v.content.$model" v-focus>{{content}}</textarea>
        <div style="max-width: 300px; display: flex; width: 100%; justify-content: space-between; flex-direction: row">
            <a @click="$router.go(-1)">Back</a>
            <button @click.prevent="editTask">Edit</button>
        </div>
        <small class="notif" v-if="edit !== ''">{{edit}}</small>
        <small v-if="!exist" class="notif" style="background-color: red">Aucune tâche ne correspond à l'id</small>
    </div>
</template>
<script>
    import {required} from 'vuelidate/lib/validators'
    import axios from 'axios'
    export default {
        name: 'updateTask',
        data() {
            return {
                content: '',
                edit: '',
                exist: true
            }
        },
        validations: {
            content: {
                required
            }
        },
        directives: {
            focus: {
                inserted: function (el) {
                    el.focus()
                }
            }
        },
        beforeMount() {
            axios.get('http://127.0.0.1:8000/api/tasks/' + this.$route.params.id).then(res => {
                if (res.data === 404) {
                    this.exist = false
                } else {
                    this.content = res.data.content
                }
            })
        },
        methods: {
            editTask() {
                if (this.$v.content.required) {
                    axios.patch('http://127.0.0.1:8000/api/tasks/' + this.$route.params.id, {content: this.content}).then(res => {
                        if (res.status === 200)
                            this.edit = 'Edit was successfully !'
                    })
                }
            }
        }
    }
</script>
<style lang="scss" scoped>
    .error {
        border: 1px solid red;
    }
    .update {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding-top: 100px;
    }
    textarea {
        background-color: #404D6B;
        max-width: 300px;
        color: white;
        width: 100%;
        padding: 10px 15px;
        font-size: 16px;
        border-radius: 7px;
        border: 1px solid transparent;
        outline: none;
    }
    button, a{
        padding: 2px 8px;
        border: none;
        border-radius: 7px;
        font-size: 14px;
        color: white;
        background-color: limegreen;
        font-weight: bolder;
        text-decoration: none;
        outline: none;
        cursor: pointer;
        margin-top: 10px;
    }
    a {
        background-color: red;
    }
    .notif {
        max-width: 300px;
        width: 100%;
        margin-top: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 7px;
        border: none;
        background-color: limegreen;
        padding: 15px;
        font-weight: bold;
    }
</style>
