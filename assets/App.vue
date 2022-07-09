<template>
    <div>
        <Index />
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import Index from './Index.vue'

    export default defineComponent({
        components: {
            Index
        },
        
        // props: {
        //     name: String,
        //     msg: { type: String, required: true },
        //     firstname: String,
        // },
        
        // mounted() {
        //     this.name // type: string | undefined
        //     this.msg // type: string
        //     this.count // type: number
        // }
    })
</script>
