import axios from 'axios';
import qs from 'qs';

const api = axios.create({
    baseURL: 'http://39edaa4f0927.ngrok.io',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    }
})

export const getCep = payload => api.post(`/getCepData`, qs.stringify(payload));

const apis = {
    getCep
}

export default apis