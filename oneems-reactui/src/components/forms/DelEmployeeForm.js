import React from "react";
import propTypes from 'prop-types';
import { connect } from "react-redux";
import {Form, Button, Message} from "semantic-ui-react";
import validator from 'validator';
import InlineError from "../messages/InlineError";
import { Redirect } from "react-router-dom";
import { BrowserRouter, Route } from 'react-router-dom';

class DelEmployeeForm extends React.Component{
    state = {
        rein: null
    }

    constructor(props) {
        super(props);     
    }

    handleClick = event => {
        console.log(this.id.value);

        const requestOptions = {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'x-access-token' : localStorage.loginJWT   },
            body: JSON.stringify({ 'id':this.id.value, 'token': localStorage.loginJWT })
        };
        fetch('/api/employeedelete', requestOptions)
        .then(response => response.json())
        .then(data => this.setState({                
        }));
            
        console.log(this.state);
        //this.setState({rein: true});
        //this.state.redirect = '/employee';
        this.setState({ redirect: "set", 'operation': "delete" });    
        console.log('The link was clicked.');
        
    }

    render(){
        if(this.state.redirect)
            return <Redirect to={{
            pathname: '/employee',
            state: { operation: 'delete' }
        }} />
        return(
            <Form onSubmit={this.onSubmit}>
                <div class="ui message">
                <div class="content">
                    <div class="header">Are you sure want to delete?</div>
                    <input type="hidden" ref={(c) => this.id = c} name="id" value={this.props.id}/>
                    <p>
                    <ul><li>Username - {this.props.username}</li></ul>
                    <ul><li>First Name - {this.props.fname}</li></ul>
                    <ul><li>Last Name  - {this.props.lname}</li></ul>
                    <ul><li>Email - {this.props.email}</li></ul>
                    </p>
                </div>
                </div>
                <Button onClick={this.handleClick} primary>Confirm</Button>
            </Form>
        )
    }
}


DelEmployeeForm.propTypes = {
    submit: propTypes.func.isRequired
};

export default DelEmployeeForm;