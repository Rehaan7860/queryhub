export default () => {
    const modify = (user, model) => {
        return user.id === model.user_id
    }
    const accept = (user, answer) => {
        return user.id === answer.question.user_id
    }

    return {
        modify,
        accept
    }
}
