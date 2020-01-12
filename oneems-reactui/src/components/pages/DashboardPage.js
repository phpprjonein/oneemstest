import React from "react";
import PropTypes from "prop-types";
import {connect} from "react-redux";
import ConfirmEmailMessage from "../messages/ConfirmEmailMessage"
import Header from '../common/Header';
import Navbar from '../common/Navbar';
import Footer from '../common/Footer';

const DashboradPage = ({ isConfirmed }) => (
    <div>
        {!isConfirmed && <><Header /><Navbar /></>}
        <div className="oneems-pages">
        {!isConfirmed && <ConfirmEmailMessage />}
        </div>
        {!isConfirmed && <Footer />}
    </div>
);

DashboradPage.propTypes = {
    isConfirmed: PropTypes.bool.isRequired
};

function mapStateProps(state) {
    return {
        isConfirmed: !!state.user.confirmed
    }
}

export default connect(mapStateProps)(DashboradPage);