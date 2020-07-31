import React from 'react';
import useStyles from './use-styles';

const About = () => {
	const styles = useStyles();
	return (
		<div className={styles.container}>
			ESSE EH O Sobre
		</div>
	);
}

export default React.memo(About);