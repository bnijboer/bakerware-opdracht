<template>
    <div>
        <form @submit.prevent="storeUser">
            <label for="firstName" />
            <input id="firstName" type="text" v-model="firstName" name="firstName" placeholder="Enter first name" required>
            
            <label for="lastName" />
            <input id="lastName" type="text" v-model="lastName" name="lastName" placeholder="Enter last name" required>
            
            <button type="submit">Create user</button>
        </form>
        
        <form @submit.prevent="findUser">
            <label for="id" />
            <input id="id" type="text" v-model="id" name="id" placeholder="Enter user ID" required>
            
            <button type="submit">Find user</button>
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
    </div>
</template>

<script lang="ts">
    import { defineComponent } from 'vue'

    export default defineComponent({
        data() {
            return {
                user: null,
                message: null,
                firstName: null,
                lastName: null,
                id: null
            }
        },
        
        watch: {
            user() {
                this.message = 'Successfully fetched user from the UserManager service!';
            }
        },
        
        computed: {
            fullName(): string {
                return this.user.firstName + ' ' + this.user.lastName;
            }
        },
        
        methods: {
            storeUser() {
                const url: string = '/users';
                
                const payload: object = {
                    firstName: this.firstName,
                    lastName: this.lastName
                };

                const data = new FormData();
                
                data.append("user", JSON.stringify(payload));
                
                fetch(url, {
                    method: 'POST',
                    body: data
                })
                .then(data => {
                    return data.json();
                })
                .then(response => {
                    this.message = response.message;
                    console.log(this.message);
                });
            },
            
            findUser() {
                const url: string = '/users/' + this.id;
                
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
    
    form {
        margin-bottom: 20px;
    }
</style>