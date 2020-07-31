const fs = require("fs");
const https = require("https");
const express = require("express");
const app = express();
const axios = require('axios');
const { resolve } = require("path");

let token = '';

const getToken = () => {
	return new Promise((resolve, reject) => {
		var FormData = require('form-data');
		var data = new FormData();
		data.append('client_secret', '83bc3861e96accc0defcae42488f5c632ec296cb335ebe3484a53405a165fd58');
		data.append('email', 'contato@pegaki.com.br');

		var config = {
			method: 'post',
			url: 'https://api.pegaki.com.br/authentication',
			headers: {
				...data.getHeaders()
			},
			data: data
		};

		axios(config)
			.then(function (response) {
				resolve({ token: response.data.id_token });
			})
			.catch(function (error) {
				resolve({ error })
			});
	})
}


//CALL PEGAKI API
app.get('/token', async (req, res) => {
	if (token) {
		res.send({ token });
	} else {
		let result = await getToken();
		res.send(result);
	}
})

//CALL PEGAKI API POINTS
app.get('/getNearbyData', async (req, res) => {
	if (!token) {
		let result = await getToken();
		token = result.token;
	}
	var FormData = require('form-data');
	var data = new FormData();
	data.append('client_secret', '83bc3861e96accc0defcae42488f5c632ec296cb335ebe3484a53405a165fd58');
	data.append('email', 'contato@pegaki.com.br');

	var config = {
		method: 'get',
		url: 'https://api.pegaki.com.br/pontos/' + req.query.cep,
		headers: {
			'Authorization': 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBpLnBlZ2FraS5jb20uYnIiLCJhdWQiOiJodHRwczpcL1wvYXBpLnBlZ2FraS5jb20uYnIiLCJzdWIiOiJUc3JsTDN2SlNLNmZLSEhrVmZKRjREUjV2UUN0ZGxiV21jMU4yaFltUjB6VnV1ZGxWN2IzNWouaVZteH5DUWRGcE1UcUFzVUpnTWlnS0dveW1LQjNPZy0tIn0.d-XU1Zi8bsakqUJTLswSJZAdP8wDehVrT2G53DasT8U'
		}
	};

	axios(config)
		.then(function (response) {
			res.send(response.data);
		})
		.catch(function (error) {
			res.send({error});
		});

})

app.listen(3002, () => console.log(`Server http running on port 3002`))

//HTTPS SERVER
https.createServer(
	{
		key: fs.readFileSync("server.key"),
		cert: fs.readFileSync("server.cert")
	}, app).listen(3001, () => {
		console.log("Server https running on port 3001");
		process.env["NODE_TLS_REJECT_UNAUTHORIZED"] = 0;
	});
