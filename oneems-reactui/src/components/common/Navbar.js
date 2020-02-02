import React from 'react';
import { Nav, handleSelect, NavDropdown  } from "react-bootstrap";


function Navbar() {
  const handleSelect =  (eventKey) =>  {
      console.log(`selected1 ${eventKey} `);
    };
    return (
<Nav variant="pills" activeKey="2" onSelect={handleSelect}>
      <Nav.Item>
        <Nav.Link eventKey="1" href="/home" title="Home">
          Home
        </Nav.Link>
      </Nav.Item>
      <Nav.Item>
        <Nav.Link href="/employee" eventKey="2" title="Employee">
          Employees
        </Nav.Link>
      </Nav.Item>
      <Nav.Item>
        <Nav.Link href="/dashboard" eventKey="3" eventKey="3" title="Dashboard">
          Dashboard
        </Nav.Link>
      </Nav.Item>
      <NavDropdown title="Dropdown" id="nav-dropdown">
        <NavDropdown.Item eventKey="4.1">Action</NavDropdown.Item>
        <NavDropdown.Item eventKey="4.2">Another action</NavDropdown.Item>
        <NavDropdown.Item eventKey="4.3">Something else here</NavDropdown.Item>
        <NavDropdown.Divider />
        <NavDropdown.Item eventKey="4.4">Separated link</NavDropdown.Item>
      </NavDropdown>
    </Nav>
    );
  }
  
  export default Navbar;