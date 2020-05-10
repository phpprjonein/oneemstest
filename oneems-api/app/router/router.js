const verifySignUp = require('./verifySignUp');
const authJwt = require('./verifyJwtToken');

module.exports = function(app) {

    const controller = require('../controller/controller.js');
 
	app.post('/api/auth/signup', [verifySignUp.checkDuplicateUserNameOrEmail, verifySignUp.checkRolesExisted], controller.signup);
	
	app.post('/api/auth/signin', controller.signin);

	app.get('/api/test/user', [authJwt.verifyToken], controller.userContent);
	
	app.get('/api/test/pm', [authJwt.verifyToken, authJwt.isPmOrAdmin], controller.managementBoard);
	
	app.get('/api/test/admin', [authJwt.verifyToken, authJwt.isAdmin], controller.adminBoard);

	//Custom Routes

	app.post('/api/auth', controller.signin);

	app.post('/api/employees', controller.employees);

	app.post('/api/addemployee', [authJwt.verifyToken, verifySignUp.checkDuplicateUserNameOrEmail], controller.empsignup);
	//, verifySignUp.checkDuplicateUserNameOrEmailDuringUpdate
	app.post('/api/updateemployee', [authJwt.verifyToken, verifySignUp.checkDuplicateUserNameOrEmailDuringUpdate], controller.empupdate);
	app.post('/api/employeeget', [], controller.employeeget);
	app.post('/api/employeedelete', [authJwt.verifyToken], controller.employeedelete);

}