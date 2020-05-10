import React from "react";
import PropTypes from "prop-types";
import { connect } from "react-redux";
import LoginHeader from '../common/LoginHeader';
import AddEmployeeForm from "../forms/AddEmployeeForm.js";
import { employee } from "../../actions/auth";
import Header from '../common/Header';
import Navbar from '../common/Navbar';
import Footer from '../common/Footer';


class AddEmployeePage extends React.Component{
    submit = data => 
        this.props.employee(data).then();
    render() {
        return (
    <div>
        {<><Header /><Navbar /></>}
        <div className="oneems-pages">
                <div>
                    <AddEmployeeForm submit={this.submit}/>
                </div>
        </div>
        {<Footer />}
    </div>
        ); 
    }
}

AddEmployeePage.propTypes = {
    history: PropTypes.shape({
        push: PropTypes.func.isRequired
    }).isRequired,
    employee: PropTypes.func.isRequired
}


export default connect(null, { employee })(AddEmployeePage);