import React from 'react';
import { AppBar, Grid, Paper, Link } from '@material-ui/core';
import { Facebook, Instagram, GitHub } from 'react-feather';

import useStyles from './use-styles' ;

export function Footer(){
	const styles = useStyles(); 
	const socialMedia = "Acesse nossas redes sociais.";
	const contact = "Telefone: (48)xxxx-xxxx - Rua teste, xx";

	return (
		<AppBar className={styles.mainFooter}> 
			<Grid container spacing={3}>
				<Grid item xs={6} className={styles.gridFooter}>
					<Paper className={styles.paper}>{contact}</Paper>
				</Grid>

				<Grid item xs={6} className={styles.gridFooter}>
					<Paper className={styles.paper}>{socialMedia}</Paper>
					<Link href="" target="_blank" className={styles.icon}><Facebook color="white"/></Link>
					<Link href="" target="_blank" className={styles.icon}><Instagram color="white"/></Link>
					<Link href="" target="_blank"className={styles.icon}><GitHub color="white"/></Link>
				</Grid>
			</Grid>
		</AppBar>
	);
}