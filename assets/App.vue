<template>
    <div>
        <form @submit="findUser">
            <label for="id">Id:</label>
            <input id="id" type="text" ref="id" v-model="id" name="id">
            
            <button type="submit">Find user by id</button>
        </form>
        
        <div v-if="user">
            <div class="row">
                <div class="heading">Normal property:</div>
                <div>First name: {{ user.firstName }}</div>
            </div>
            
            <div class="row">
                <div class="heading">Computed property:</div>
                <div>Full name: {{ fullName }}</div>
            </div>
            
            <div class="row">
                <div class="heading">Watcher:</div>
                <div>Message: {{ message }}</div>
            </div>
        </div>
        
        <form action="/users" method="POST">
            <label for="firstName">First name:</label>
            <input id="firstName" type="text" v-model="firstName" name="firstName" required>
            
            <label for="lastName">Last name:</label>
            <input id="lastName" type="text" v-model="lastName" name="lastName" required>
            
            <button type="submit">Create user</button>
        </form>
    </div>
</template>

<script lang="ts">
    import { defineComponent } from 'vue'

    export default defineComponent({
        data() {
            return {
                user: null,
                message: null
            }
        },
        
        watch: {
            user() {
                this.message = 'Successfully fetched last name from the UserRepository service!';
            }
        },
        
        computed: {
            fullName(): string {
                return this.user.firstName + ' ' + this.user.lastName;
            }
        },
        
        methods: {
            findUser(event) {
                event.preventDefault();
                
                const url: string = '/users/' + this.$refs.id.value;
                
                fetch(url)
                    .then(data => {
                        return data.json();
                    })
                    .then(response => {
                        this.user = response.user;
                    });
            }
        }
    })
</script>

<style scoped>
    .heading {
        font-weight: bold;
    }
    
    .row {
        margin-bottom: 10px;
    }
    
    button {
        display: block;
    }
</style>