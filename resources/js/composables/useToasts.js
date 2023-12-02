import {
    createToast,
    ToastOptions,
    ToastContent,
    clearToasts
} from 'mosha-vue-toastify'

const invokeToast = (content, options) =>
    createToast(content, {
        type: 'danger',
        timeout: 10000,
        position: 'bottom-center',
        showIcon: true,
        transition: 'slide',
        ...options
    })

/**
 * Success messages and form complete
 *
 * @param {ToastContent} content
 * @param {ToastOptions} options
 */
export const successToast = (content = {}, options = {}) =>
    invokeToast(content, { type: 'success', timeout: 5000, ...options })

/**
 * Warning messages and form complete
 *
 * @param {ToastContent} content
 * @param {ToastOptions} options
 */
export const warningToast = (content = {}, options = {}) =>
    invokeToast(content, { type: 'warning', timeout: 8000, ...options })

/**
 * Error messages and form validation errors
 *
 * @param {ToastContent} content
 * @param {ToastOptions} options
 */
export const errorToast = (content = {}, options = {}) =>
    invokeToast(content, { type: 'danger', timeout: 10000, ...options })

/**
 * Critical messages and errors that break the app
 *
 * @param {ToastContent} content
 * @param {ToastOptions} options
 */
export const criticalToast = (content = {}, options = {}) =>
    invokeToast(content, { type: 'danger', timeout: -1, ...options })

/**
 * Form validation toast
 *
 */
export const formValidationToast = () => {
    errorToast({
        title: 'Check the form for errors',
        description: 'Ensure the form has been completed correctly'
    })
}

export const clearAllToasts = () => {
    clearToasts()
}
