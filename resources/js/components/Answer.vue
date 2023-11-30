<template>
    <div class="media post">
        <div class="row w-auto">
            <div class="media-body">
                <form v-if="editing" @submit.prevent="update">
                    <div class="form-group">
                        <textarea
                            rows="10"
                            class="form-control"
                            required
                            v-model="body"
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
            <div class="row">
                <div class="col-md-auto">
                    <slot name="vote-controls"></slot>
                </div>
                <div class="col-md-11 mt-2">
                    <div>{{ answer.body }}</div>
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
                        >
                            <i class="fas fa-pencil-alt fa-lg text-primary"></i>
                        </a>
                        <button type="submit" class="border-0 bg-transparent">
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
import { computed, ref, toRefs, watch, watchEffect } from 'vue'
import UserInfo from './UserInfo.vue'

const props = defineProps({
    answer: { type: Object, default: () => {} }
})

const { answer } = toRefs(props)

const editing = ref(false)
const body = ref(answer.value.body)
const id = ref(answer.value.id)
const questionId = ref(answer.value.question_id)
const beforeEditCache = ref(null)

const isInvalid = computed(() => body.value.length < 10)
const update = () => {
    axios
        .patch(` ${questionId.value}/answers/${id.value}`, {
            body: body.value
        })
        .then((res) => {
            body.value = res.data.body
            editing.value = false
            // alert(res.data.message)
            location.reload()
        })
        .catch((err) => {
            console.log('Something went wrong')
        })
}

const edit = () => {
    beforeEditCache.value = body.value
    editing.value = true
}

const cancel = () => {
    body.value = beforeEditCache.value
    editing.value = false
}
</script>
