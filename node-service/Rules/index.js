const Utils = require("../Utils/utils.js");
const express = require("express");
const morgan = require("morgan");

class Rules {
	constructor(express) {
		this.app = express;
		this.startCheck(this.app);
	}

	startCheck(app) {
		app.use(morgan("dev"));
		app.use(express.json());
		app.use(express.urlencoded({ extended: true }));
		app.use(Utils.checkAuth);
	}
}

module.exports = Rules;
