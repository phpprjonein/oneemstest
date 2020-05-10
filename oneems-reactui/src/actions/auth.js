import { USER_LOGGED_IN, USER_LOGGED_OUT } from "../types";
import api from "../api";

export const userLoggedIn = (user) => ({ 
    type: USER_LOGGED_IN,
    user
});

export const userLoggedOut = () => ({ 
    type: USER_LOGGED_OUT
});

export const login = (credentials) => dispatch => 
api.user.login(credentials).then(
    user => {
        localStorage.loginJWT = user.token;
        localStorage.email = user.email;
        dispatch(userLoggedIn(user));
    }
);

export const employee = (employee) => dispatch => 
api.user.employee(employee).then(
    employee => {
        
    }
);
export const updateemployee = (employee) => dispatch => 
api.user.updateemployee(employee).then(
    employee => {
        
    }
);

export const employeeget = (id) => dispatch => 
api.user.employeeget(id).then(
    user => {
        console.log("111111111111" + user.email + "222222222");
    }
);

export const logout = () => dispatch => {
        localStorage.removeItem("loginJWT");
        localStorage.removeItem("email");
        dispatch(userLoggedOut());

};