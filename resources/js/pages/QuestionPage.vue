<template>
    <div class="container mt-5">
        <Question :question="question"></Question>
        <Answers :question="question"></Answers>
    </div>
</template>

<script setup>
const props = defineProps(['question'])

import Question from '../components/Question.vue'
import Answers from '../components/Answers.vue'
</script>
