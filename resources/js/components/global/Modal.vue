<template>
    <transition name="fade">
        <div class="modal" v-if="modalActive">
            <transition name="modal-animation-inner">
                <div class="modal-dialog" v-if="modalActive">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ modalTitle }}</h5>
                            <button
                                type="button"
                                class="btn-close"
                                @click="close"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <slot></slot>
                        </div>
                        <div class="modal-footer">
                            <button
                                @click="close"
                                type="button"
                                class="btn btn-outline-secondary"
                            >
                                Close
                            </button>
                            <button
                                type="button"
                                @click="submitButton"
                                class="btn btn-primary"
                            >
                                {{ buttonText }}
                            </button>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </transition>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps(['modalActive', 'modalTitle', 'buttonText'])

const emit = defineEmits(['close', 'submitButton'])

const close = () => {
    emit('close')
}

const submitButton = () => {
    emit('submitButton')
}
</script>

<style lang="scss" scoped>
.modal {
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    overflow: auto;
}

/* Styling for the modal content */
.modal-dialog {
    position: relative;
    margin: 10% auto;
    padding: 1rem;
}

/* Styling for the modal header */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1rem;
}
</style>
