import axios from "axios";

export default {
    user: {
        login: (credentials) => axios.post('api/auth', {credentials}).then(res => res.data.user),
        //employee: (employee) => axios.post('api/addemployee', {employee}).then(res => res.data.user),
        //employee: (employee) => axios.post('api/addemployee', {headers: { 'Content-Type': 'application/json', 'x-access-token' : localStorage.loginJWT}, employee}).then(res => res.data.user),
        employee: (employee) => axios.post('api/addemployee', {employee}, {
			headers: { 'Content-Type': 'application/json', 'x-access-token' : localStorage.loginJWT}, 
		}).then(res => res.data.user),
        updateemployee: (employee) => axios.post('api/updateemployee', {employee}, {
			headers: { 'Content-Type': 'application/json', 'x-access-token' : localStorage.loginJWT}, 
		}).then(res => res.data.user),
        employeeget: (id) => axios.post('/api/employeeget', {id}).then(res => res.data.user),
        delemployee: (id) => axios.post('/api/delemployee', {id}).then(res => res.data.user)
        
    }
}

