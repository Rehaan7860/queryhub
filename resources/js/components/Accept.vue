<template>
    <a
        v-if="canAccept"
        title="Mark this answer as the best answer"
        :class="classes"
        @click.prevent="create"
    >
        <i class="fas fa-check fa-2x"></i>
    </a>

    <a
        v-if="accepted"
        href=""
        title="User who asked this question has accepted this answer as the best answer"
        class="text-decoration-none mt-3"
    >
        <i class="fas fa-check fa-2x"></i>
    </a>
</template>

<script setup>
import { computed, defineProps, onMounted, ref, toRefs } from 'vue'
import { createToast } from 'mosha-vue-toastify'
import policies from '../composables/policies.js'

const props = defineProps(['answer'])

const { answer } = toRefs(props)

const isBest = ref(answer.value.is_best)
const id = ref(answer.value.id)

const canAccept = computed(() => {
    return authorize('accept', answer.value)
})

const accepted = computed(() => !canAccept.value && isBest.value)

const classes = computed(() => ['mt-2', isBest.value ? 'vote-accepted' : ''])

const authorize = (policy, model) => {
    if (!window.Auth.signedIn) return false

    if (typeof policy === 'string' && typeof model === 'object') {
        const user = window.Auth.user

        return user.id === answer.value.question.user_id
    }
}

const create = async () => {
    await axios
        .post(`/answers/${id.value}/accept`)
        .then((res) => {
            createToast(
                {
                    title: 'Success!',
                    description: res.data.message
                },
                {
                    type: 'success',
                    timeout: 5000,
                    position: 'bottom-center'
                }
            )
            isBest.value = true
        })
        .catch((err) => {
            console.log(err)
        })
}
</script>
