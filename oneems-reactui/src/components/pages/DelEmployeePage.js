import React from "react";
import PropTypes from "prop-types";
import { connect } from "react-redux";
import LoginHeader from '../common/LoginHeader';
import AddEmployeeForm from "../forms/AddEmployeeForm.js";
import DelEmployeeForm from "../forms/DelEmployeeForm.js";
import { employeeget } from "../../actions/auth";
import Header from '../common/Header';
import Navbar from '../common/Navbar';
import Footer from '../common/Footer';
import axios from "axios";


class DelEmployeePage extends React.Component{
    constructor(props){
        super(props);
        //alert(this.props.match.params.id);
        console.log(this.props);
        this.state = {
            data: {
                fname: 'Saravanan',
                lname: 'Anbazhagan',
                email: 'tosaravanan.a@gmail.com',
                name: 'saravanandota',
            },
        }
    }

    componentDidMount() {
         // Simple POST request with a JSON body using fetch
    const requestOptions = {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ 'id':this.props.match.params.id })
    };
    fetch('/api/employeeget', requestOptions)
        .then(response => response.json())
        .then(data => this.setState({ 
                id: data.user.id,
                username: data.user.username, 
                fname: data.user.fname, 
                lname: data.user.lname, 
                email: data.user.email                  
                }));
    }


    render() {
        console.log(this.state.email);
         return (
    <div>
        {<><Header /><Navbar /></>}
        <div className="oneems-pages">
                <div>
                    <DelEmployeeForm id={this.state.id} username={this.state.username} fname={this.state.fname} lname={this.state.lname} email={this.state.email} submit={this.submit}/>
                </div>
        </div>
        {<Footer />}
    </div>
        ); 
    }
}

export default connect(null, { employeeget })(DelEmployeePage);