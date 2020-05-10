import React from 'react';
import PropTypes from "prop-types";
import {Route} from 'react-router-dom';
import HomePage from './components/pages/HomePage';
import LoginPage from './components/pages/LoginPage';
import DashboardPage from './components/pages/DashboardPage';
import EmployeePage from './components/pages/EmployeePage';
import AddEmployeePage from './components/pages/AddEmployeePage';
import EditEmployeePage from './components/pages/EditEmployeePage';
import DelEmployeePage from './components/pages/DelEmployeePage';
import GuestRoute from './components/routes/GuestRoute';
import UserRoute from './components/routes/UserRoute';

const App = ({location}) => <div className="ui container">
  <Route location={location}  path="/" exact component={props => <LoginPage {...props} />} />
  <UserRoute location={location}  path="/home" exact component={props => <HomePage {...props} />} />
  <Route location={location} path="/login" exact component={props => <LoginPage {...props} />} />
  <UserRoute location={location} path="/dashboard" exact component={props => <DashboardPage {...props} />} />
  <UserRoute location={location} path="/employee" exact component={props => <EmployeePage {...props} />} />
  <UserRoute location={location} path="/addemployee" exact component={props => <AddEmployeePage {...props} />} />
  <UserRoute location={location} path="/delemployee/:id" exact component={props => <DelEmployeePage {...props} />} />
  <UserRoute location={location} path="/editemployee/:id" exact component={props => <EditEmployeePage {...props} />} />
</div>

App.propTypes = {
  location: PropTypes.shape({
    pathname: PropTypes.string.isRequired
  }).isRequired
}

export default App;
