<template>
    <Modal
        button-text="Confirm"
        @close="toggleModal"
        :modal-active="modalActive"
        modal-title="Delete Answer"
        @submit-button="destroy"
    >
        <div>
            <p>
                Are you sure you want to delete this question? This change is
                permanent.
            </p>
        </div>
    </Modal>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form class="card-body" v-if="editing" @submit.prevent="update">
                    <div class="card-title">
                        <input
                            type="text"
                            class="form-control form-control-lg"
                            v-model="title"
                        />
                    </div>

                    <hr />

                    <div class="media">
                        <div class="row w-auto">
                            <div class="media-body">
                                <div class="form-group">
                                    <textarea
                                        rows="10"
                                        class="form-control"
                                        required
                                        v-model="body"
                                    ></textarea>
                                </div>
                                <div
                                    class="mt-3 d-flex justify-content-end gap-2"
                                >
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
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card-body" v-else>
                    <div class="card-title">
                        <div
                            class="d-flex align-items-center justify-content-between"
                        >
                            <h2 class="fw-bolder my-auto">{{ title }}</h2>
                            <a
                                href="/questions"
                                class="btn btn-outline-secondary"
                                >Back to all questions</a
                            >
                        </div>
                    </div>

                    <hr />

                    <div class="media">
                        <div class="row w-auto">
                            <div class="col-md-auto ms-0">
                                <vote
                                    :model="question"
                                    :name="'question'"
                                ></vote>
                            </div>

                            <div class="media-body text-wrap col-md mt-2">
                                {{ body }}
                            </div>
                        </div>
                    </div>

                    <div
                        class="mt-3 row d-flex justify-content-between align-items-center text-end"
                    >
                        <div class="col-md">
                            <div class="d-flex align-items-center gap-2 mt-5">
                                <a
                                    @click.prevent="edit"
                                    class="border-0 bg-transparent"
                                    v-if="authorize('modify', question)"
                                >
                                    <i
                                        class="fas fa-pencil-alt fa-lg text-primary"
                                    ></i>
                                </a>

                                <button
                                    v-if="authorize('deleteQuestion', question)"
                                    @click="toggleModal"
                                    class="border-0 bg-transparent"
                                >
                                    <i
                                        class="fas fa-trash fa-lg text-danger"
                                    ></i>
                                </button>
                            </div>
                        </div>

                        <div class="text-end col-md">
                            <UserInfo :model="question" label="Asked" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, toRefs } from 'vue'
import UserInfo from './UserInfo.vue'
import { createToast } from 'mosha-vue-toastify'
import Modal from './global/Modal.vue'

const props = defineProps(['question'])

const { question } = toRefs(props)

const title = ref(question.value.title)
const body = ref(question.value.body)
const editing = ref(false)
const id = ref(question.value.id)
const beforeEditCache = ref({})

const modalActive = ref(false)

const isInvalid = computed(() => {
    return body.value.length < 10 || title.value.length < 10
})

const endpoint = computed(() => `/questions/${id.value}`)

const edit = () => {
    beforeEditCache.value = {
        body: body.value,
        title: title.value
    }

    editing.value = true
}

const cancel = () => {
    body.value = beforeEditCache.value.body
    title.value = beforeEditCache.value.title

    editing.value = false
}

const update = () => {
    axios
        .put(endpoint.value, {
            body: body.value,
            title: title.value
        })
        .catch((err) => {
            createToast(
                {
                    title: 'Error',
                    description: err.data.message
                },
                {
                    type: 'danger',
                    timeout: 5000,
                    position: 'bottom-center'
                }
            )
        })
        .then(({ data }) => {
            body.value = data.body_html

            createToast(
                {
                    title: 'Success',
                    description: data.message
                },
                {
                    type: 'success',
                    timeout: 5000,
                    position: 'bottom-center'
                }
            )

            editing.value = false
        })
}

const destroy = async () => {
    await axios
        .delete(endpoint.value)
        .then(({ data }) => {
            createToast(
                {
                    title: 'Success',
                    description: data.message
                },
                {
                    type: 'success',
                    timeout: 3000,
                    position: 'bottom-center'
                }
            )
            toggleModal()

            setTimeout(() => {
                window.location.href = '/questions'
            }, 3000)
        })
        .catch((err) => {
            createToast(
                {
                    title: 'Error',
                    description: err.data.message
                },
                {
                    type: 'danger',
                    timeout: 5000,
                    position: 'bottom-center'
                }
            )
            toggleModal()
        })
}
const toggleModal = () => {
    modalActive.value = !modalActive.value
}

const authorize = (policy, model) => {
    if (!window.Auth.signedIn) return false

    if (typeof policy === 'string' && typeof model === 'object') {
        const user = window.Auth.user

        return user.id === question.value.user_id
    }
}

const deleteQuestion = (user) => {
    return (
        user.id === question.value.user_id && question.value.answers_count < 1
    )
}
</script>
