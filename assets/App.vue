<template>hoi {{ count }}</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        // type inference enabled
        
        props: {
            name: String,
            msg: { type: String, required: true }
        },
        
        data() {
            return {
                count: 1
            }
        },
        
        created() {
            console.log('hoi ik ben vue')
        },
        
        mounted() {
            this.name // type: string | undefined
            this.msg // type: string
            this.count // type: number
        }
    })
</script>
