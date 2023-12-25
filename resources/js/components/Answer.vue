<template>
    <div class="media post">
        <Modal
            button-text="Confirm"
            @close="toggleModal"
            :modal-active="modalActive"
            modal-title="Delete Answer"
            @submit-button="destroy"
        >
            <div>
                <p>
                    Are you sure you want to delete this answer? This change is
                    permanent.
                </p>
            </div>
        </Modal>
        <div class="row w-auto">
            <div class="media-body">
                <form v-if="editing" @submit.prevent="update">
                    <div class="form-group">
                        <textarea
                            rows="10"
                            class="form-control"
                            required
                            v-model="state.answer.body"
                        ></textarea>
                    </div>
                    <div class="mt-3 d-flex justify-content-end gap-2">
                        <button
                            type="submit"
                            class="btn btn-primary"
                            :disabled="isInvalid"
                        >
                            Update
                        </button>
                        <button
                            class="btn btn-outline-secondary"
                            type="button"
                            @click="cancel"
                        >
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div v-if="!editing" class="answer_row">
            <transition name="fadedown">
                <div class="row">
                    <div class="col-md-auto">
                        <vote :model="answer" :name="'answer'"></vote>
                    </div>
                    <div class="col-md-11 mt-2">
                        <div>{{ state.answer.body }}</div>
                    </div>
                </div>
            </transition>
            <div
                class="mt-3 row d-flex justify-content-between align-items-center text-end"
            >
                <div class="col-md">
                    <div class="d-flex align-items-center gap-2 mt-5">
                        <a
                            v-if="authorize('modify', answer)"
                            @click.prevent="edit"
                            class="border-0 bg-transparent"
                        >
                            <i class="fas fa-pencil-alt fa-lg text-primary"></i>
                        </a>

                        <button
                            v-if="authorize('modify', answer)"
                            @click="toggleModal"
                            class="border-0 bg-transparent"
                        >
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </div>
                </div>

                <div class="col-md">
                    <slot name="author"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {
    computed,
    defineProps,
    onMounted,
    reactive,
    ref,
    toRefs,
    defineEmits
} from 'vue'
import { createToast } from 'mosha-vue-toastify'
import 'mosha-vue-toastify/dist/style.css'
import Modal from '../components/global/Modal.vue'
import { useModal } from '../composables/useModal.js'

const { openModal, closeModal, isModalOpen } = useModal()

const props = defineProps({
    answer: { type: Object, default: () => ({}) },
    authEdit: null,
    authDelete: null
})

const { answer } = toRefs(props)

const emit = defineEmits(['handleAnswerDeleted'])

const editing = ref(false)
const modalComponentRef = ref(null)

const modalActive = ref(false)

const toggleModal = () => {
    modalActive.value = !modalActive.value
}

onMounted(() => {
    // console.log('modalComponentRef:', modalComponentRef)
    // console.log('modalComponentRefValue:', modalComponentRef.value)
})

const state = reactive({
    answer: { ...props.answer } || { body: '' },
    beforeEditCache: null
})

const isInvalid = computed(() => {
    return state.answer && state.answer.body && state.answer.body.length < 10
})

const endpoint = computed(() => {
    return `${
        state.answer && state.answer.question_id ? state.answer.question_id : ''
    }/answers/${state.answer && state.answer.id ? state.answer.id : ''}`
})

const authorize = (policy, model) => {
    if (!window.Auth.signedIn) return false

    if (typeof policy === 'string' && typeof model === 'object') {
        const user = window.Auth.user

        return user.id === answer.value.user_id
    }
}

const fetchAnswers = async () => {
    try {
        answer.value = await axios.get('/answers')
        console.log(answer.value)
    } catch (err) {
        console.log(err)
    }
}
const update = async () => {
    try {
        const response = await axios.patch(endpoint.value, {
            body: state.answer.body
        })

        // Update only the body property
        state.answer.body = response.data.body

        editing.value = false

        createToast(
            {
                title: 'Answer Updated',
                description: response.data.message
            },
            {
                type: 'success',
                timeout: 5000,
                position: 'bottom-center'
            }
        )
    } catch (err) {
        console.log('error updating data', err)
    }
}

// Come back to this to fix reactivity issue on deletion!
const destroy = async () => {
    await axios
        .delete(endpoint.value)
        .then(() => {
            createToast(
                {
                    title: 'Answer Deleted',
                    description: 'The answer has been deleted successfully.'
                },
                {
                    type: 'success',
                    timeout: 5000,
                    position: 'bottom-center'
                }
            )
            toggleModal()
        })
        .catch((err) => {
            createToast(
                {
                    title: 'Error',
                    description: 'The answer cannot be deleted.'
                },
                {
                    type: 'success',
                    timeout: 5000,
                    position: 'bottom-center'
                }
            )
            toggleModal()
        })
        .finally(() => {
            fetchAnswers()
        })
}

const edit = () => {
    state.beforeEditCache = { ...state.answer }
    editing.value = true
}

const cancel = () => {
    state.answer = { ...state.beforeEditCache }
    editing.value = false
}
</script>
