import { ref, onMounted, onBeforeUnmount } from 'vue'

export function useModal() {
    const isModalOpen = ref(false)

    const openModal = () => {
        isModalOpen.value = true
    }

    const closeModal = () => {
        isModalOpen.value = false
    }

    const toggleModal = () => {
        isModalOpen.value = !isModalOpen.value
    }

    const closeOnEsc = (event) => {
        if (event.key === 'Escape' && isModalOpen.value) {
            closeModal()
        }
    }

    onMounted(() => {
        window.addEventListener('keydown', closeOnEsc)
    })

    onBeforeUnmount(() => {
        window.removeEventListener('keydown', closeOnEsc)
    })

    return {
        isModalOpen,
        openModal,
        closeModal,
        toggleModal
    }
}
