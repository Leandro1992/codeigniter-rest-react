import axios from 'axios';
import qs from 'qs';

const api = axios.create({
    baseURL: 'http://39edaa4f0927.ngrok.io',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    }
})

export const login = payload => api.post(`/login`, qs.stringify(payload))

//GETTING BETTER THIS FOR A SESSION MIDDLEWARE AUTENTICATION ON THE FUTURE.
export const checkToken = token => new Promise((resolve, reject) => { resolve({ data: { success: true } }) })



const apis = {
    login,
    checkToken
}

export default apis