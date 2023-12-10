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
        class="{{ $model->status }} text-decoration-none mt-3"
    >
        <i class="fas fa-check fa-2x"></i>
    </a>
</template>

<script setup>
import { computed, defineProps, ref, toRefs } from 'vue'
import { createToast } from 'mosha-vue-toastify'

const props = defineProps(['answer'])

const { answer } = toRefs(props)

const isBest = ref(answer.value.is_best)
const id = ref(answer.value.id)

const canAccept = computed(() => true)

const accepted = computed(() => !canAccept.value && isBest.value)

const classes = computed(() => ['mt-2', isBest.value ? 'vote-accepted' : ''])

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
