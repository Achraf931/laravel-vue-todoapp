<template>
    <div class="tasks">
        <h1>Home</h1>
        <input v-bind:class="{notError: $v.newTask.required}" type="text" v-model.trim="$v.newTask.$model" @keyup.enter="createTask" v-focus>
        <div id="container">
            <task v-for="task in tasks" :key="task.id" :task="task" @deleteTask="deleteTask"></task>
        </div>
    </div>
</template>
<script>
    import {required} from 'vuelidate/lib/validators'
    import Task from '../components/Task.vue'
    import axios from 'axios'
    export default {
        name: 'home',
        data() {
            return {
                tasks: [],
                newTask: ''
            }
        },
        validations: {
            newTask: {
                required
            }
        },
        components: {
            Task
        },
        directives: {
            focus: {
                inserted: function (el) {
                    el.focus()
                }
            }
        },
        mounted() {
            axios.get('/api/tasks').then(res => {
                this.tasks = res.data
            })
        },
        methods: {
            createTask() {
                if (this.$v.newTask.required) {
                    axios.post('/api/tasks', {content: this.newTask}).then(res => {
                        this.tasks.unshift(res.data)
                        this.newTask = ''
                    })
                } else {
                    document.querySelector('input').classList.add('error')
                }
            },
            deleteTask(task) {
                axios.delete('/api/tasks' + task.id).then(() => {
                    this.tasks.forEach(e => {
                        if (e === task){
                            this.tasks.splice(this.tasks.indexOf(e), 1)
                        }
                    })
                })
            }
        }
    }
</script>
<style lang="scss">
    .error {
        border: 1px solid red;
    }
    .notError {
        border: 1px solid transparent!important;
    }
    * {
        font-family: Nunito;
        box-sizing: border-box;
    }
    body {
        color: white;
        background-color: #263048;
    }
    .tasks {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    h1 {
        text-align: center;
    }
    input {
        max-width: 300px;
        width: 100%;
        padding: 10px 15px;
        font-size: 16px;
        border-radius: 7px;
        border: 1px solid transparent;
        outline: none;
    }
    #container {
        max-width: 80%;
        width: fit-content;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: wrap;
        margin: auto;

        div {
            background-color: #404D6B;
            border-radius: 7px;
            max-width: 300px;
            width: 100%;
            margin: 20px 0;
            padding: 15px;
            list-style: none;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
        }
    }
</style>
