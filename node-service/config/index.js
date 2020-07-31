const path = require("path");
require("dotenv").config({
	path: path.resolve(process.cwd(), `config/.env.${process.env.NODE_ENV}`)
});

const primaryConnection = {
	user: process.env.FM_PRIMARY_USER,
	password: process.env.FM_PRIMARY_PASSWORD,
	host: process.env.FM_PRIMARY_HOST,
	database: process.env.FM_PRIMARY_DATABASE
};

const config = {
	user: process.env.FM_USER,
	password: process.env.FM_PASSWORD,
	host: process.env.FM_HOST,
	database: process.env.FM_DATABASE
};

module.exports = {
	primaryConnection,
	config
};
