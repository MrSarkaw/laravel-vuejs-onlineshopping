const state = {
    data:[]
};

const actions = {
    setUser({state}, payload){
        state.data = payload
    }
};



export default{
    state, namespaced:true,
    actions
}