<template>
    <div>
        <div class="row">
            <div class="heading">Normal property:</div>
            <div>First name: {{ firstName }}</div>
        </div>
        
        <div v-if="lastName" class="row">
            <div class="heading">Computed property:</div>
            <div>Full name: {{ fullName }}</div>
        </div>
        
        <button @click="getData">Print full name</button>
    </div>
</template>

<script lang="ts">
    import { defineComponent } from 'vue'

    export default defineComponent({
        data() {
            return {
                firstName: 'Brendan',
                lastName: null,
                success: null
            }
        },
        
        watch: {
            lastName() {
                if (this.success) {
                    console.log('Successfully fetched last name from the UserRepository service!');
                }
            }
        },
        
        computed: {
            fullName(): string {
                return this.firstName + ' ' + this.lastName;
            }
        },
        
        methods: {
            getData() {
                const url: string = '/fetch';
                
                fetch(url)
                    .then(data => {
                        return data.json();
                    })
                    .then(response => {
                        this.lastName = response.lastName;
                        this.success = true;
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