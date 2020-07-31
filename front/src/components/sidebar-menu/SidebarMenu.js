import React from 'react';
import PropTypes from 'prop-types'
import {
	List, Divider, IconButton, ListItem,
	ListItemIcon, ListItemText,
} from '@material-ui/core';
import {
	ChevronLeft, ChevronRight, ListAlt
} from '@material-ui/icons';
import { useTheme } from '@material-ui/core/styles';
import { Link } from "react-router-dom";
import useStyles, { Sidebar } from './use-styles'

export function SidebarMenu({ handleDrawerClose, open }) {
	const theme = useTheme();
	const classes = useStyles();
	//TODO use redux for language settings
	const language = 'pt_BR';

	const features = [
		{
			pt_BR: {
				name: 'Home',
				href: '/home'
			},
			en_US: {
				name: 'Home',
				href: '/home'
			},
			Icon: ListAlt,
		},
		{
			pt_BR: {
				name: 'Sobre',
				href: '/about'
			},
			en_US: {
				name: 'About',
				href: '/about'
			},
			Icon: ListAlt,
		}
	];

	return (
		<Sidebar
			className={classes.drawer}
			variant="persistent"
			anchor="left"
			open={open}
			classes={{
				paper: classes.drawerPaper,
			}}
		>
			<div className={classes.drawerHeader}>
				<IconButton color="inherit" onClick={handleDrawerClose}>
					{theme.direction === 'ltr' ? <ChevronLeft /> : <ChevronRight />}
				</IconButton>
			</div>
			<Divider />
			<List>
				{features.map((elem) => (
					<ListItem button key={elem[language].name} component={Link} to={elem[language].href}>
						<IconButton color="inherit">
							<ListItemIcon>{<elem.Icon />}</ListItemIcon>
							<ListItemText primary={elem[language].name} />
						</IconButton>
					</ListItem>
				))}
			</List>
		</Sidebar>
	);
}

SidebarMenu.propTypes = {
	handleDrawerClose: PropTypes.func,
	open: PropTypes.bool
}

SidebarMenu.defaultProps = {
	handleDrawerClose: () => { },
	open: false
}
