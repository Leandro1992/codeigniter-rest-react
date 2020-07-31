import React, { useState } from 'react';
import useStyles, { GreenAvatar, MyButton } from './use-styles'
import { Typography, Grid } from '@material-ui/core'
import TextField from '@material-ui/core/TextField';
import FindInPageIcon from '@material-ui/icons/FindInPage';
import serviceHome from '../../services/home';
import MapContainer from '../../components/maps/maps';
import { CSVLink } from "react-csv";


const Home = () => {

	const [cep, setCep] = useState("");
	const [points, setPoints] = useState([]);
	const styles = useStyles()

	const search = async () => {
		const payload = { cep };
		try {
			const responseCEP = await serviceHome.getCep(payload);
			if (responseCEP.data.results) {
				console.log(responseCEP.data.results)
				const data = [];
				for (const i of responseCEP.data.results) {
					data.push({ nome_fantasia: i.nome_fantasia, cep: i.cep, telefone: i.telefone, complemento: i.complemento, lat: (+i.latitude), lng: (+i.longitude) })
				}
				setPoints(data);
			}
		} catch (e) {
			console.log(e)
			alert("Ocorreu um erro ao tentar buscar dados")
		}
	}

	return (
		<Grid container className={styles.container}>
			<Grid container justify="center" alignItems="center" className={styles.container}>
				<div className={styles.paper}>
					<GreenAvatar>
						<FindInPageIcon />
					</GreenAvatar>
					<Typography component="h1" variant="h5">
						Informe o CEP
			</Typography>
					<form className={styles.form}>
						<TextField
							variant="outlined"
							margin="normal"
							required
							type="number"
							fullWidth
							onChange={(ev) => setCep(ev.target.value)}
							label="CEP"
							name="cep"
							autoComplete="CEP"
							className="input"
							autoFocus
						/>

						<MyButton
							variant="contained"
							color="primary"
							onClick={search}
							disabled={!cep}
						>Pesquisar
			  		</MyButton>
						<MyButton
							variant="contained"
							color="primary"
							disabled={points.length === 0}
						><CSVLink className={styles.download} data={points} enclosingCharacter={`'`}>
								Baixar Resultados
				</CSVLink>
						</MyButton>
					</form>
				</div>

			</Grid>
			<Grid container justify="center" alignItems="center" className={styles.container}>
				<MapContainer points={points} />
			</Grid>
		</Grid>
	);
}

export default React.memo(Home)
