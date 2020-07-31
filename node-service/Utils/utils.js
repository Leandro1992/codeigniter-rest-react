const fs = require("fs");
const privateKEY = fs.readFileSync("./Utils/private.key", "utf8");
const publicKEY = fs.readFileSync("./Utils/public.key", "utf8");
const Filter = require("../Filters/filters");

const Util = {

};

module.exports = Util;
