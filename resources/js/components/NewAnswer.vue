<template>
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Add an answer to this question</h3>
                    </div>
                    <hr />
                    <form @submit.prevent="create">
                        <div class="form-group">
                            <textarea
                                name="body"
                                class="form-control"
                                id=""
                                cols="30"
                                rows="7"
                                required
                                v-model="body"
                            ></textarea>
                        </div>
                        <div class="form-group mt-3 text-end">
                            <button
                                type="submit"
                                :disabled="isInvalid"
                                class="btn btn-outline-primary btn-lg"
                            >
                                Submit Answer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, ref, toRefs } from 'vue'
import { createToast } from 'mosha-vue-toastify'
const props = defineProps(['questionId'])

const { questionId } = toRefs(props)

const emit = defineEmits(['created'])

const body = ref('')
const signedIn = ref(true)

const isInvalid = computed(() => !signedIn.value || body.value.length < 10)

const create = () => {
    axios
        .post(`/questions/${questionId.value}/answers`, {
            body: body.value
        })
        .catch((err) => {
            createToast(
                {
                    title: 'Error',
                    description: err.response.data.message
                },
                {
                    type: 'danger',
                    timeout: 5000,
                    position: 'bottom-center'
                }
            )
        })
        .then(({ data }) => {
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
            body.value = ''
            emit('created', data.answer)
        })
}
</script>
