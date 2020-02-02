import React from 'react';
import logo from '../../ncmlogo.png';
import PropTypes from "prop-types";
import {Link} from "react-router-dom";
import {connect} from "react-redux";
import * as actions from "../../actions/auth";

function Header({ isAuthenticated, logout }) {
    return (
     <div>
        <header className="main-header">
          <div className="nav top-menu">
            <div className="float-left box logo-box">
              <Link to="/"><img src={logo} className="App-logo" height="24px" alt="NCM logo" /></Link>
              <h4>OneEMS</h4>
            </div>
            <div className="float-right box profile-box">
              <ol className="nav navbar-nav text-center">
                <li className="dropdown messages-menu"><b>Welcome </b>
                  <span className="hidden-xs"> {localStorage.email}</span> | {isAuthenticated ? <Link to="/login" onClick={() => logout()}>Logout</Link> : <Link to="/login">Login</Link>}
                </li>
              </ol>
            </div>
          </div>
        </header>
        <hr className="border border-danger" />
      </div>
    );
  }
  
Header.propTypes = {
    isAuthenticated: PropTypes.bool.isRequired,
    logout: PropTypes.func.isRequired
};

function mapStateToProps(state) {
    console.log(state);
  return { 
      isAuthenticated: !!state.user.token 
    }
}


  export default connect(mapStateToProps, {logout: actions.logout})(Header);
