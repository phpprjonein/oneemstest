import '../../css/jquery.dataTables.css';
import React, { Component } from "react";

import 'datatables.net-dt/css/jquery.dataTables.css';
import 'datatables.net-buttons-dt/css/buttons.dataTables.css';

const $ = require('jquery');
$.DataTable = require('datatables.net');


require( 'datatables.net-buttons/js/dataTables.buttons.min' );
require( 'datatables.net-buttons/js/buttons.html5.min' );

const jzip = require( 'jzip');
window.JSZip = jzip;
const pdfmake = require( 'pdfmake');
var pdfMake = require('pdfmake/build/pdfmake.js');
var pdfFonts = require('pdfmake/build/vfs_fonts.js');
pdfMake.vfs = pdfFonts.pdfMake.vfs;



export class Tbl extends Component{
    componentDidMount(){
        this.$el = $(this.el);
        this.$el.DataTable(
            {
                'dom': 'Bfrtip',
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'/api/employees'
                },
                'order': [[ 1, 'asc' ]],
                'columns': [
                    { data: 'username', "orderable": true},
                    { data: 'email', "orderable": true},
                ],
                'buttons': [
                          'copyHtml5',
                          'excelHtml5',
                          'csvHtml5',
                          'pdfHtml5'
                      ]
            }
        )
    }
    componentWillUnmount(){
        $('#oneemsdt').DataTable().destroy();
        //this.$el.DataTable.destroy(true);
    }
    render(){
        //console.log(this.props.data);
        
        return <div>
            <table id="oneemsdt" className="display" width="100%" ref={el => this.el = el}>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            </table>
        </div>
    }
}