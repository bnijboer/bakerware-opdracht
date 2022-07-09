<template>
    <div>
        <div class="row">
            <div class="heading">Normal variable:</div>
            <div>First name: {{ firstName }}</div>
        </div>
        
        <div v-if="lastName" class="row">
            <div class="heading">Computed variable:</div>
            <div>Full name: {{ fullName }}</div>
        </div>
        
        <div v-if="message" class="row">
            <div class="heading">Watched variable:</div>
            <div>Message: {{ message }}</div>
        </div>
        
        <button @click="getData">Append last name</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                firstName: 'Brendan',
                lastName: null,
                message: null
            }
        },
        
        watch: {
            message() {
                console.log(this.message);
            }
        },
        
        computed: {
            fullName() {
                return this.firstName + ' ' + this.lastName;
            }
        },
        
        methods: {
            getData() {
                const url = '/fetch';
                
                fetch(url)
                    .then(data => {
                        return data.json();
                    })
                    .then(response => {
                        this.lastName = response.lastName;
                        this.message = 'Successfully fetched last name from the UserRepository service!';
                    });
            }
        }
    }
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