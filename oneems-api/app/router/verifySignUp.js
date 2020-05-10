const db = require('../config/db.config.js');
const config = require('../config/config.js');
var sequelize = require('sequelize');
const ROLEs = config.ROLEs; 
const User = db.user;
const Role = db.role;

checkDuplicateUserNameOrEmail = (req, res, next) => {
	// -> Check Username is already in use
	User.findOne({
		where: {
			username: req.body.employee.name
		} 
	}).then(user => {
		if(user){
			res.status(400).send({errors:{global: "Fail -> Username is already taken!"}});
			//res.status(400).send("Fail -> Username is already taken!");
			return;
		}
		
		// -> Check Email is already in use
		User.findOne({ 
			where: {
				email: req.body.employee.email
			} 
		}).then(user => {
			if(user){
				res.status(400).send({errors:{global: "Fail -> Email is already in use!"}});
				return;
			}
				
			next();
		});
	});
}

checkDuplicateUserNameOrEmailDuringUpdate = (req, res, next) => {

	console.log('checkDuplicateUserNameOrEmailDuringUpdate');

   console.log('Saravanan ' + req.body.employee.id);



	// -> Check Username is already in use
	User.findOne({
		where: {
			username: req.body.employee.name,
			id: {[sequelize.Op.not]: req.body.employee.id}
		} 
	}).then(user => {
		if(user){
			res.status(400).send({errors:{global: "Fail -> Username is already taken!"}});
			//res.status(400).send("Fail -> Username is already taken!");
			return;
		}
		
		// -> Check Email is already in use
		User.findOne({ 
			where: {
				email: req.body.employee.email,
				id: {[sequelize.Op.not]: req.body.employee.id}
			} 
		}).then(user => {
			if(user){
				res.status(400).send({errors:{global: "Fail -> Email is already in use!"}});
				return;
			}
				
			next();
		});
	});
}

checkRolesExisted = (req, res, next) => {	
	for(let i=0; i<req.body.roles.length; i++){
		if(!ROLEs.includes(req.body.roles[i].toUpperCase())){
			res.status(400).send("Fail -> Does NOT exist Role = " + req.body.roles[i]);
			return;
		}
	}
	next();
}

const signUpVerify = {};
signUpVerify.checkDuplicateUserNameOrEmail = checkDuplicateUserNameOrEmail;
signUpVerify.checkDuplicateUserNameOrEmailDuringUpdate = checkDuplicateUserNameOrEmailDuringUpdate;
signUpVerify.checkRolesExisted = checkRolesExisted;

module.exports = signUpVerify;