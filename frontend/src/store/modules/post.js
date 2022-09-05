import axios from '../../axios'

const state = {
    data:[],
    search:'',
    selectedCategory:[]
};

const actions = {
    load({state}){
      
        axios.post('getpost', {
            q:state.search,
            category:state.selectedCategory
        }).then(({data})=>{
           state.data = data.posts
        })
    },

    clearSearch({state, dispatch}){
        state.search = '';
        dispatch('load')
    }
};



export default{
    state, namespaced:true,
    actions
}