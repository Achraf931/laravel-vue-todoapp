<template>
    <div>
        <p>{{task.content}}</p>
        <img src="../../assets/img/cross.png" alt="cross" @click="deleteTask">
        <router-link class="button" :to="'/' + task.id">Edit</router-link>
    </div>
</template>
<script>
    export default {
        name: 'home',
        props: ['task'],
        methods: {
            deleteTask() {
                this.$emit('deleteTask', this.task)
            }
        }
    }
</script>
<style scoped lang="scss">
    div {
        position: relative;

        img {
            position: absolute;
            right: 10px;
            top: 10px;
            width: 10px;
            height: 10px;
            cursor: pointer;
        }
        .button {
            padding: 2px 8px;
            border: none;
            border-radius: 7px;
            font-size: 14px;
            color: white;
            background-color: #2EA1FB;
            font-weight: bolder;
            text-decoration: none;
            align-self: flex-end;
        }
    }
</style>
