<script setup>
defineProps(["facts"]);
</script>

<template v-for="fact in facts">
    <p>
        <i>{{ fact.fact }}</i>
    </p>
</template>
