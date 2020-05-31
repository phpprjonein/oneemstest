import React, { useState } from 'react';
import { Nav, handleSelect, NavDropdown  } from "react-bootstrap";
import PropTypes from "prop-types";
import {connect} from "react-redux";
import ConfirmEmailMessage from "../messages/ConfirmEmailMessage"
import Header from '../common/Header';
import Navbar from '../common/Navbar';
import Footer from '../common/Footer';
import {Tbl} from '../tables/Tbl';
import {Form, Button, Message} from "semantic-ui-react";

const EmployeePage = (props,{isConfirmed}) => {
    //const [greeting, setGreeting, operation] = useState();
    const location_state = props.location.state ? props.location.state : '';
    window.history.pushState(null, '')
 return (   <div>
        {!isConfirmed && <><Header /><Navbar /></>}
        <div className="oneems-pages">
            {location_state.operation === "delete" ? 
    <Message positive> 
        <p>Employee Deleted successfully</p>
    </Message>:''}
                {location_state.operation === "add" ? 
    <Message positive> 
        <p>Employee Added successfully</p>
    </Message>:''}
    {location_state.operation === "update" ? 
    <Message positive> 
        <p>Employee Updated successfully</p>
    </Message>:''}
                <div className="mb-sm-4 row">
    <div className="col-lg-10 col-md-9"></div>
    <div className="col-auto col-auto">
        <Nav.Link href="/addemployee" className="btn pull-right btn-success editBtn"  title="Add Employee">
          <i aria-hidden="true" class="add big icon"></i><p class="name"></p>
        </Nav.Link>     
    </div>
</div>
        
        {!isConfirmed && <Tbl></Tbl>}
        </div>
        {!isConfirmed && <Footer />}
    </div>);
};

EmployeePage.propTypes = {
    isConfirmed: PropTypes.bool.isRequired
};

function mapStateProps(state) {
    return {
        isConfirmed: !!state.user.confirmed
    }
}

export default connect(mapStateProps)(EmployeePage);