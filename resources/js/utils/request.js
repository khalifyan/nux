import axios from 'axios'

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

const service = axios.create({
    baseURL: '/api',
    timeout: 12000000,
})

service.interceptors.request.use(
    config => {
        if (!config.params) {
            config.params = {}
        }
        return config
    },
    error => {
        return Promise.reject(error)
    }
)

const successStatuses = [200, 201, 204];

service.interceptors.response.use(
    response => {
        if (response && !successStatuses.includes(response.status)) {
            return Promise.reject(new Error(response.message || 'Error'))
        } else {
            return response
        }
    },
    error => {
        console.log(error.message, 'error')
        return Promise.reject(error)
    }
)

export default service

