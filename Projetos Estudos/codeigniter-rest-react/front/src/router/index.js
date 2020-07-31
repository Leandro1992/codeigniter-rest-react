import React from 'react';
import { BrowserRouter as Router, Route, Switch, Redirect } from "react-router-dom";

import Home from '../views/home';
import About from '../views/about';
import Login from '../views/login';

import { Header } from '../components/header/Header';
import { SidebarMenu } from '../components/sidebar-menu/SidebarMenu';
import '../App.css';
import clsx from 'clsx';
import CssBaseline from '@material-ui/core/CssBaseline';
import useStyles from '../style';
import serviceLogin from '../services/login';

export default () => {

	const routes = [
		{
			routedComponent: Login,
			paths: {
				pt_BR: '/',
				en_US: '/',
			},
			exact: true

		},
		{
			routedComponent: Home,
			paths: {
				pt_BR: '/home',
				en_US: '/home',
			}

		},
		{
			routedComponent: About,
			paths: {
				pt_BR: '/about',
				en_US: '/about',
			}
		}
	]
	const language = 'pt_BR';
	const classes = useStyles();

	const [open, setOpen] = React.useState(false);

	const handleDrawerOpen = () => {
		setOpen(true);
	};

	const handleDrawerClose = () => {
		setOpen(false);
	};

	const checkPath = () => {
		let result = false;
		for (const route of routes) {
			if (route.paths[language] === window.location.pathname) result = true;
		}
		return result
	};

	class MenuHeader extends React.Component {
		render() {
			return window.location.pathname === '/' || !checkPath() ? null :
				(
					<>
						<CssBaseline />
						<Header onClick={handleDrawerOpen} open={open} />
						<SidebarMenu handleDrawerClose={handleDrawerClose} open={open} />
						<div
							className={clsx(classes.content, {
								[classes.contentShift]: open,
							})}
						>
						</div>
					</>
				)
		}
	}

	class PrivateRoute extends React.Component {
		state = {
			haveAcces: false,
			loaded: false,
		}

		componentDidMount() {
			this.checkAcces();
		}

		checkAcces = () => {
			const token = localStorage.getItem('@codeigniter/token')
			if (token) {
				serviceLogin.checkToken({ token }).then(result => {
					if (result.data.success) {
						this.setState({
							haveAcces: true,
							loaded: true,
						});
					} else {
						this.setState({
							haveAcces: false,
							loaded: true,
						});
					}
				})
			} else {
				this.setState({
					haveAcces: false,
					loaded: true,
				});
			}
		}

		render() {
			const { component: Component, ...rest } = this.props;
			const { loaded, haveAcces } = this.state;
			if (!loaded) return null;
			return (
				<Route
					{...rest}
					render={props => {
						return haveAcces ? (
							<Component {...props} />
						) : (
								<Redirect
									to={{
										pathname: '/',
									}}
								/>
							);
					}}
				/>
			);
		}
	}

	return (
		<Router>
			<div className={classes.root}>
				<MenuHeader />
				<Switch>
					{routes.map((route, index) => (
						route.paths[language] === '/' ?
							<Route
								key={index}
								path={route.paths[language]}
								component={route.routedComponent}
								exact={route.exact}
							/> :
							<PrivateRoute
								key={index}
								path={route.paths[language]}
								component={route.routedComponent}
								exact={route.exact}
							/>
					))}
					<Redirect from='*' to='/' />
				</Switch>
			</div>
		</Router>
	);
}