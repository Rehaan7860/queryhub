<template>
    <div>
        <!--        <button @click="openModal" class="btn btn-primary">-->
        <!--            {{ triggerText }}-->
        <!--        </button>-->

        <div v-if="isModalOpen" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ modalTitle }}</h5>
                        <button
                            type="button"
                            class="btn-close"
                            @click="closeModal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div class="modal-footer">
                        <button
                            v-for="(button, index) in buttons"
                            :key="index"
                            class="btn"
                            :class="button.class"
                            @click="handleButtonClick(button)"
                        >
                            {{ button.text }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, defineEmits, ref } from 'vue'
import { useModal } from '../../composables/useModal.js'

const props = defineProps(['triggerText', 'modalTitle', 'buttons'])
const emit = defineEmits(['buttonClick'])

const { isModalOpen, openModal, closeModal } = useModal()

const handleButtonClick = (button) => {
    // Pass the button text to the parent component for handling
    emit('buttonClick', button.text)

    // Close the modal if needed
    if (button.closeModal) {
        closeModal()
    }
}
</script>

<style scoped>
/* Additional styling for the modal overlay */
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
