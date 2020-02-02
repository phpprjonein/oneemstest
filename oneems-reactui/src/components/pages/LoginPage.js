import React from "react";
import PropTypes from "prop-types";
import { connect } from "react-redux";
import LoginHeader from '../common/LoginHeader';
import LoginForm from "../forms/LoginForm.js";
import { login } from "../../actions/auth";

class LoginPage extends React.Component{
    submit = data => 
        this.props.login(data).then(() => this.props.history.push("/employee"));
    render() {
        return (
        <div className="App">
            <LoginHeader/>
            <div className="login-page">
			    <div className="logo">
				    <h4>OneEMS</h4>
			    </div>
                <div>
                    <LoginForm submit={this.submit}/>
                </div>
            </div>
        </div>    
        ); 
    }
}

LoginPage.propTypes = {
    history: PropTypes.shape({
        push: PropTypes.func.isRequired
    }).isRequired,
    login: PropTypes.func.isRequired
}


export default connect(null, { login })(LoginPage);