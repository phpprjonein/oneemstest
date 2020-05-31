import React from 'react';
import { Nav, handleSelect, NavDropdown  } from "react-bootstrap";


function Navbar() {
  const handleSelect =  (eventKey) =>  {
      console.log(`selected1 ${eventKey} `);
    };
    return (
<Nav variant="pills" activeKey="1" onSelect={handleSelect}>
      <Nav.Item>
        <Nav.Link eventKey="1" href="/employee" title="Home">
          Network Elements
        </Nav.Link>
      </Nav.Item>
      <Nav.Item>
        <Nav.Link href="#" eventKey="2" title="Employee">
          Backup 
        </Nav.Link>
      </Nav.Item>
      <NavDropdown title="Configuration" id="nav-dropdown">
        <NavDropdown.Item eventKey="4.1">Load Template - Modification</NavDropdown.Item>
        <NavDropdown.Item eventKey="4.2">Generate Script - Golden</NavDropdown.Item>
        <NavDropdown.Item eventKey="4.3">Generate Script - Modification</NavDropdown.Item>
        <NavDropdown.Divider />
        <NavDropdown.Item eventKey="4.4">Script Rerun</NavDropdown.Item>
        <NavDropdown.Item eventKey="4.4">Batch Tracking</NavDropdown.Item>
      </NavDropdown>
      <NavDropdown title="Discovery" id="nav-dropdown">
        <NavDropdown.Item eventKey="5.1">Discovery IPs</NavDropdown.Item>
        <NavDropdown.Item eventKey="5.2">Discovery Results</NavDropdown.Item>
        <NavDropdown.Item eventKey="5.3">Manual Discovery</NavDropdown.Item>
      </NavDropdown>
      <NavDropdown title="Maintenance" id="nav-dropdown">
        <NavDropdown.Item eventKey="5.1">Software Delivery</NavDropdown.Item>
        <NavDropdown.Item eventKey="5.2">Reboot</NavDropdown.Item>
        <NavDropdown.Item eventKey="5.3">Boot	Order Sequence</NavDropdown.Item>
        <NavDropdown.Item eventKey="5.3">Device Cleanup</NavDropdown.Item>
      </NavDropdown>
      <NavDropdown title="Tools" id="nav-dropdown">
        <NavDropdown.Item eventKey="5.1">CyberArk</NavDropdown.Item>
        <NavDropdown.Item eventKey="5.2">Health Check</NavDropdown.Item>
        <NavDropdown.Item eventKey="5.3">Show Tech </NavDropdown.Item>
      </NavDropdown>
      <NavDropdown title="Audit" id="nav-dropdown">
        <NavDropdown.Item eventKey="5.1">Compliance</NavDropdown.Item>
        <NavDropdown.Item eventKey="5.2">Customize Audit</NavDropdown.Item>
        <NavDropdown.Item eventKey="5.3">Customize Audit History</NavDropdown.Item>
      </NavDropdown>
      <Nav.Item>
        <Nav.Link href="#" eventKey="2" title="Employee">
          Inventory 
        </Nav.Link>
      </Nav.Item>
      <Nav.Item>
        <Nav.Link href="#" eventKey="2" title="Employee">
          Help
        </Nav.Link>
      </Nav.Item>
      


    </Nav>
    );
  }
  
  export default Navbar;