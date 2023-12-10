<template>
    <a
        href=""
        title="Click to mark as favorite question (Click again to undo)"
        :class="classes"
        class="text-decoration-none"
        @click.prevent="toggle"
    >
        <i class="fas fa-star fa-2x position-relative"></i>
        <span
            class="favorites-count d-block fw-semibold text-center"
            :class="[{ 'text-warning': isFavorited }]"
        >
            {{ count }}
        </span>
    </a>
</template>

<script setup>
import { computed, defineProps, ref, toRefs } from 'vue'
import { createToast } from 'mosha-vue-toastify'

const props = defineProps({
    question: { type: Object, default: () => ({}) }
})

const { question } = toRefs(props)

const isFavorited = ref(question.value.is_favorited)
const count = ref(question.value.favorites_count)
const id = ref(question.value.id)

const endpoint = computed(() => `/questions/${id.value}/favorites`)

const signedIn = computed(() => window.Auth.signedIn)

const classes = computed(() => {
    return [
        'favorite',
        'mt-2',
        !signedIn.value ? 'off' : isFavorited.value ? 'favorited' : ''
    ]
})

const toggle = () => {
    if (!signedIn.value) {
        createToast(
            {
                title: 'Login',
                description: 'Please login in to favorite a question'
            },
            {
                type: 'warning',
                timeout: 5000,
                position: 'bottom-center'
            }
        )
    }
    isFavorited.value ? destroy() : create()
}

const destroy = async () => {
    await axios.delete(endpoint.value).then((res) => {
        count.value--
        isFavorited.value = false
    })
}

const create = async () => {
    await axios.post(endpoint.value).then((res) => {
        count.value++
        isFavorited.value = true
    })
}
</script>
