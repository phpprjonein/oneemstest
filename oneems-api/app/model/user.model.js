module.exports = (sequelize, Sequelize) => {
	const User = sequelize.define('users', {
	  fname: {
		  type: Sequelize.STRING
	  },
		lname: {
		  type: Sequelize.STRING
	  },
	  username: {
		  type: Sequelize.STRING
	  },
	  password: {
		  type: Sequelize.STRING
	  },
		email: {
		  type: Sequelize.STRING
	  },
	});
	
	return User;
}