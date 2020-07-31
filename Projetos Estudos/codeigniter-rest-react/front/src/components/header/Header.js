import React from 'react';
import PropTypes from 'prop-types'
import clsx from 'clsx';
import { Toolbar, Button, IconButton, MenuItem, Menu } from '@material-ui/core';
import { AccountCircle, Menu as MenuIcon } from '@material-ui/icons';

import useStyles, { HeaderBar } from './use-styles'
import logo from '../../logo.png';

export function Header({ onClick, open }) {
	const styles = useStyles();
	const [anchorEl, setAnchorEl] = React.useState(null);
	const handleClick = (event) => {
		setAnchorEl(event.currentTarget);
		console.log(event.currentTarget);
	};

	const logout = () => {
		localStorage.clear();
		window.location.assign("/login");
	}

	const sigin = async () => {
		window.location.assign("/registrar");
	}

	const handleClose = () => {
		setAnchorEl(null);
	};
	return (
		<HeaderBar
			position="fixed"
			className={clsx(styles.appBar, {
				[styles.appBarShift]: open,
			})}
		>
			<Toolbar className={styles.iconsParent}>
				<div>
					<IconButton
						color="inherit"
						aria-label="open drawer"
						onClick={onClick}
						edge="start"
						className={clsx(styles.menuButton, open && styles.hide)}
					>
						<MenuIcon />
					</IconButton>
					<IconButton href="/" color="inherit">
						<img className={styles.logo} alt="Logo" src={logo} />
					</IconButton>
				</div>
				<div className={styles.perfil}>
					<Button
						color="inherit"
						aria-controls="simple-menu"
						aria-haspopup="true"
						onClick={handleClick}
					>
						<AccountCircle />
					</Button>
					<Menu
					anchorEl={anchorEl}
					keepMounted
					open={Boolean(anchorEl)}
					onClose={handleClose}
					>
						<MenuItem onClick={handleClose}>Profile</MenuItem>
						<MenuItem onClick={sigin}>Create Account</MenuItem>
						<MenuItem onClick={logout}>Logout</MenuItem>
					</Menu>
				</div>
			</Toolbar>
		</HeaderBar>
	);
}

Header.propTypes = {
	onClick: PropTypes.func,
	open: PropTypes.bool
}

Header.defaultProps = {
	onClick: () => { },
	open: false
}
