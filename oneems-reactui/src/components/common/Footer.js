import React from 'react';

class Footer extends React.Component{
    render(){
        return <footer className="footer">
            <div className="ui container">
                <div className="text-center text-muted">&copy; {(new Date().getFullYear())} OneEMS. All rights
                    reserved. All content is confidential and proprietary.</div>
            </div>
        </footer>
    }
}

export default Footer;