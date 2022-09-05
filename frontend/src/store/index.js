import { createStore } from 'vuex'

import user from './modules/user'
import post from './modules/post'

export default createStore({
    modules:{user, post}
})