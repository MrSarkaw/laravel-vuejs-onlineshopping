import axios from 'axios'

if(localStorage.getItem('token')){
    axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('token')
}

export default axios.create({
    baseURL:"http://127.0.0.1:8000/api/"
})