<template>
    <div>
        A very good template by {{ msg }}
    </div>
</template>
<script>
export default {
    name: 'Test',
    props: {
        msg: {
            type: String,
            default: 'Mona Moxie'
        }
    }
}
</script>