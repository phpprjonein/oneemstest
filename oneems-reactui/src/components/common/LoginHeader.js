import React from 'react';
import logo from '../../ncmlogo.png';

function LoginHeader() {
    return (
      <header className="main-header">
			<div className="nav">
				<div className="pull-left box">
					<a className="navbar-brand" href="#"> 
          <img src={logo} className="App-logo" height="24px" alt="NCM logo" />
					</a>
				</div>
			</div>
			<hr className="border border-danger"/>
		</header>
    );
  }
  
  export default LoginHeader;
  