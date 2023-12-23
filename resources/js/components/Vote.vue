<template>
    <div class="d-flex flex-column w-auto align-items-center vote-controls">
        <a
            @click.prevent="voteUp"
            href=""
            :title="title('up')"
            class="vote-up"
            :class="classes"
        >
            <i class="fas fa-caret-up fa-3x text-black"></i>
        </a>

        <span class="votes-count">{{ count }}</span>

        <a
            @click.prevent="voteDown"
            href=""
            :title="title('down')"
            class="vote-down"
            :class="classes"
        >
            <i class="fas fa-caret-down fa-3x"></i>
        </a>

        <Favorite v-if="name === 'question'" :question="model" />
        <Accept v-if="name === 'answer'" :answer="model" />
    </div>
</template>
<script setup>
import { computed, defineProps, ref, toRefs } from 'vue'
import Favorite from './Favorite.vue'
import Accept from './Accept.vue'
import { createToast } from 'mosha-vue-toastify'

const props = defineProps(['name', 'model'])

const { name, model } = toRefs(props)

const count = ref(model.value.votes_count)

const id = ref(model.value.id)

const signedIn = computed(() => window.Auth.signedIn)

const classes = computed(() => (signedIn.value ? '' : 'off'))

const endpoint = computed(() => `/${name.value}s/${id.value}/vote`)

const voteUp = () => {
    _vote(1)
}

const voteDown = () => {
    _vote(-1)
}

const _vote = async (vote) => {
    if (!signedIn.value) {
        createToast(
            {
                title: 'Login',
                description: `Please login in to vote on this ${name.value}`
            },
            {
                type: 'warning',
                timeout: 5000,
                position: 'bottom-center'
            }
        )
        return
    }
    await axios
        .post(endpoint.value, { vote })
        .then((res) => {
            createToast(
                {
                    title: 'Success',
                    description: res.data.message
                },
                {
                    type: 'success',
                    timeout: 5000,
                    position: 'bottom-center'
                }
            )

            count.value = res.data.votesCount
        })
        .catch((err) => {
            console.log('error updating data', err)
            createToast(
                {
                    title: 'Error',
                    description: 'Unable to perform this action.'
                },
                {
                    type: 'danger',
                    timeout: 5000,
                    position: 'bottom-center'
                }
            )
        })
}
const title = (voteType) => {
    let titles = {
        up: `This ${name.value} is useful`,
        down: `This ${name.value} is not useful`
    }
    return titles[voteType]
}
</script>
