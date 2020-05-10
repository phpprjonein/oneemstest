import React from "react";
import propTypes from 'prop-types';
import {Form, Button, Message} from "semantic-ui-react";
import validator from 'validator';
import { Redirect } from "react-router-dom";
import InlineError from "../messages/InlineError";

class AddEmployeeForm extends React.Component{
    state = {
        data: {
            fname: '',
            lname: '',
            email: '',
            name: '',
            password: ''
        },
        loading: false,
        errors: {},
    }
    onChange = e => 
        this.setState({
            data: { ...this.state.data, [e.target.name]:e.target.value }
        });
    onSubmit = () => { 
        const errors = this.validate(this.state.data);
        this.setState({ errors });
        if(Object.keys(errors).length === 0){
            this.setState({loading: true});
            this.props.submit(this.state.data).catch(err => 
            this.setState({errors: err.response.data.errors, loading: false})
            );
            this.setState({ redirect: "set", 'operation': "add" });
        }
    }

    validate = data => {
        const errors = {}
        if(!validator.isEmail(data.email)) errors.email = 'Invalid email';
        if(!data.fname) errors.fname = 'First Name can\'t blank'; 
        if(!data.lname) errors.lname = 'Last Name can\'t blank'; 
        if(!data.name) errors.name = 'Name can\'t blank'; 
        if(!data.password) errors.password = 'Password can\'t blank'; 
        return errors;
    }


    render(){
        if(this.state.redirect)
            return <Redirect to={{
            pathname: '/employee',
            state: { operation: 'add' }
        }} />

        const {data, errors, loading} = this.state;
        return(
            <Form onSubmit={this.onSubmit} loading={loading}>
                {errors.global && !errors.type && <Message negative> 
                <Message.Header>Something went wrong</Message.Header>
                <p>{errors.global}</p>
                </Message>
                }
                {errors.type && this.state.greeting !== "" ? 
                <Message positive> 
                <p>{errors.global}</p>
                {data.fname = data.lname = data.name = data.email = data.password = ''}
                </Message>:''}

                <Form.Field error={!!errors.name}>
                    <label htmlFor="fname">Firstame</label>
                    <input 
                    type="text" 
                    id="fname" 
                    name="fname" 
                    placeholder="Enter Employee First Name" 
                    value={data.fname}
                    onChange={this.onChange}
                    />
                    {errors.fname && <InlineError text={errors.fname}/>}
                </Form.Field>
                <Form.Field error={!!errors.lname}>
                    <label htmlFor="username">Last name</label>
                    <input 
                    type="text" 
                    id="lname" 
                    name="lname" 
                    placeholder="Enter Employee Last Name" 
                    value={data.lname}
                    onChange={this.onChange}
                    />
                    {errors.lname && <InlineError text={errors.lname}/>}
                </Form.Field>
                <Form.Field error={!!errors.name}>
                    <label htmlFor="username">Username</label>
                    <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="Enter Employee Name" 
                    value={data.name}
                    onChange={this.onChange}
                    />
                    {errors.name && <InlineError text={errors.name}/>}
                </Form.Field>
                <Form.Field error={!!errors.email}>
                    <label htmlFor="email">Email</label>
                    <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="example@example.com" 
                    value={data.email}
                    onChange={this.onChange}
                    />
                    {errors.email && <InlineError text={errors.email}/>}
                </Form.Field>
                <Form.Field error={!!errors.password}>
                    <label htmlFor="password">Password</label>
                    <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="" 
                    value={data.password}
                    onChange={this.onChange}
                    />
                    {errors.password && <InlineError text={errors.password}/>}
                </Form.Field>
                <Button primary>Add Employee</Button>
            </Form>
        )
    }
}


AddEmployeeForm.propTypes = {
    submit: propTypes.func.isRequired
};

export default AddEmployeeForm;