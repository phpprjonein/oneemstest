var Sequelize = require('sequelize');
const db = require('../config/db.config.js');
const config = require('../config/config.js');
const User = db.user;
const Role = db.role;

const Op = db.Sequelize.Op;

var jwt = require('jsonwebtoken');
var bcrypt = require('bcryptjs');

exports.signup = (req, res) => {
	// Save User to Database
	console.log("Processing func -> SignUp");
	
	User.create({
		name: req.body.name,
		username: req.body.username,
		email: req.body.email,
		password: bcrypt.hashSync(req.body.password, 8)
	}).then(user => {
		Role.findAll({
		  where: {
			name: {
			  [Op.or]: req.body.roles
			}
		  }
		}).then(roles => {
			user.setRoles(roles).then(() => {
				res.send("User registered successfully!");
            });
		}).catch(err => {
			res.status(500).send("Error -> " + err);
		});
	}).catch(err => {
		res.status(500).send("Fail! Error -> " + err);
	})
}

exports.signin = (req, res) => {
	console.log("Sign-In");
	
	User.findOne({
		where: {
			username: req.body.credentials.email
		}
	}).then(user => {
		if (!user) {
			return res.status(400).json({errors:{global: 'User Not Found.'}});
			//return res.status(404).send('User Not Found.');
		}

		var passwordIsValid = bcrypt.compareSync(req.body.credentials.password, user.password);
		if (!passwordIsValid) {
			return res.status(400).json({errors:{global: "Invalid Password!"}});
			//return res.status(401).send({ auth: false, accessToken: null, reason: "Invalid Password!" });
		}
		
		var token = jwt.sign({ id: user.id, email: user.email }, config.secret, {
		  expiresIn: 86400 // expires in 24 hours
		});
		res.status(200).send({ "user":{"auth":true, "email": req.body.credentials.email, token: token}});
		
	}).catch(err => {
		return res.status(400).json({errors:{global: 'Error -> ' + err}});
		//res.status(500).send('Error -> ' + err);
	});
}

exports.userContent = (req, res) => {
	User.findOne({
		where: {id: req.userId},
		attributes: ['username', 'email'],
		include: [{
			model: Role,
			attributes: ['id', 'name'],
			through: {
				attributes: ['userId', 'roleId'],
			}
		}]
	}).then(user => {
		res.status(200).json({
			"description": "User Content Page",
			"user": user
		});
	}).catch(err => {
		res.status(500).json({
			"description": "Can not access User Page",
			"error": err
		});
	})
}

exports.adminBoard = (req, res) => {
	User.findOne({
		where: {id: req.userId},
		attributes: ['name', 'username', 'email'],
		include: [{
			model: Role,
			attributes: ['id', 'name'],
			through: {
				attributes: ['userId', 'roleId'],
			}
		}]
	}).then(user => {
		res.status(200).json({
			"description": "Admin Board",
			"user": user
		});
	}).catch(err => {
		res.status(500).json({
			"description": "Can not access Admin Board",
			"error": err
		});
	})
}

exports.managementBoard = (req, res) => {
	User.findOne({
		where: {id: req.userId},
		attributes: ['name', 'username', 'email'],
		include: [{
			model: Role,
			attributes: ['id', 'name'],
			through: {
				attributes: ['userId', 'roleId'],
			}
		}]
	}).then(user => {
		res.status(200).json({
			"description": "Management Board",
			"user": user
		});
	}).catch(err => {
		res.status(500).json({
			"description": "Can not access Management Board",
			"error": err
		});
	})
}

//Custom routes actions

exports.employees = (req, res) => {
	console.log("Employees List Creations");

	var order = req.body.order[0];
	var columns = req.body.columns[0];
	var search = req.body.search['value'];
	
	//const orderobj = JSON.parse(order);
	
	console.log('++++++++++++++++++++++++++++++++');
	console.log(search);
	console.log('++++++++++++++++++++++++++++++++');

var draw = req.body.draw;
var row = req.body.start;
var rowperpage = req.body.length; // Rows display per page
var columnIndex = order.column;//req.order[0]['column']; // Column index
var columnName = columns.data;//req.columns[columnIndex]['data']; // Column name
var columnSortOrder = order.dir;//req.order[0]['dir']; // asc or desc
var searchValue = search;//req.search['value']; // Search value
var totalRecords = totalRecordwithFilter = 0;

User.count({
}).then(function(count) {
	totalRecords = totalRecordwithFilter = count;
});
 
console.log("########################");

console.log(totalRecords);

console.log("########################");




if(searchValue !== ''){

	User.count({
		where: {
		[Sequelize.Op.or]: [
			{username:       {[Sequelize.Op.like]: '%' + searchValue + '%'}},
			{email: {[Sequelize.Op.like]: '%' + searchValue + '%'}},
		]
  	}
}).then(function(count) {
	totalRecordwithFilter = count;
});


	User.findAll({
	offset: parseInt(row), 
  	limit: parseInt(rowperpage),
  	where: {
		[Sequelize.Op.or]: [
			{username:       {[Sequelize.Op.like]: '%' + searchValue + '%'}},
			{email: {[Sequelize.Op.like]: '%' + searchValue + '%'}},
		]
  	},
  	order: [ [ columnName, columnSortOrder ]]
	}).then(data => {
		res.status(200).json({
			"draw" : draw,
    		"iTotalRecords" : totalRecords,
    		"iTotalDisplayRecords" : totalRecordwithFilter,
    		"aaData" : data
		});
	}); 
}else{


	User.findAll({
	offset: parseInt(row), 
  	limit: parseInt(rowperpage),
  	order: [ [ columnName, columnSortOrder ]]
	}).then(data => {
		res.status(200).json({
			"draw" : parseInt(draw),
    		"iTotalRecords" : totalRecords,
    		"iTotalDisplayRecords" : totalRecordwithFilter,
    		"aaData" : data
	});
	});
	} 
}	


