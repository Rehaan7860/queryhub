<template>
    <div>
        <span class="text-muted">
            {{ postDate }}
        </span>
        <div class="media d-flex justify-content-end mt-3 align-items-center">
            <a :href="user.url" class="pe-2">
                <img :src="user.avatar" alt="" />
            </a>
            <div class="media-body">
                <a :href="user.url"> {{ user.name }}</a>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed, reactive, ref, toRefs, watchEffect } from 'vue'

const props = defineProps({
    model: { type: Object, default: () => {} },
    label: { type: String, default: null }
})

const { model, label } = toRefs(props)

const postDate = computed(() => label.value + ' ' + model.value.created_date)

const user = ref(model.value.user)
</script>
