import React from "react";
import PropTypes from "prop-types";
import { connect } from "react-redux";
import LoginHeader from '../common/LoginHeader';
import EditEmployeeForm from "../forms/EditEmployeeForm.js";
import { updateemployee } from "../../actions/auth";
import { Redirect } from "react-router-dom";
import Header from '../common/Header';
import Navbar from '../common/Navbar';
import Footer from '../common/Footer';


class EditEmployeePage extends React.Component{
        state = {
        rein: null
    }
    submit = data => 
        this.props.updateemployee(data).then(
            () => this.props.history.push({pathname:"/employee", state: { operation: 'update' }}),
            this.setState({ redirect: "set", 'operation': "update" })
        );

    render() {
        if(this.state.redirect)
            return <Redirect to={{
            pathname: '/employee',
            state: { operation: 'update' }
        }} />

        return (
    <div>
        {<><Header /><Navbar /></>}
        <div className="oneems-pages">
                <div>
                    <EditEmployeeForm  {...this.props} submit={this.submit}/>
                </div>
        </div>
        {<Footer />}
    </div>
        ); 
    }
}

EditEmployeePage.propTypes = {
    history: PropTypes.shape({
        push: PropTypes.func.isRequired
    }).isRequired,
    updateemployee: PropTypes.func.isRequired
}


export default connect(null, { updateemployee })(EditEmployeePage);