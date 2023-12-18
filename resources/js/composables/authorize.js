import policies from './policies.js'
export default () => {
    const authorize = (policy, model) => {
        if (!window.Auth.signedIn) return false

        if (typeof policy === 'string' && typeof model === 'object') {
            const user = window.Auth.user

            return policies[policy](user, model)
        }
    }
    return {
        authorize
    }
}
