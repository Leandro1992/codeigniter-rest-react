import { AppBar } from '@material-ui/core';
import { makeStyles, withStyles } from '@material-ui/core/styles';

export const HeaderBar = withStyles(theme => ({
	colorPrimary: {
		backgroundColor:'#3AB54B',
		color: 'white'
	}
}))(AppBar)

const drawerWidth = 240;

export default makeStyles( theme => ({
	appBar: {
		transition: theme.transitions.create(['margin', 'width'], {
			easing: theme.transitions.easing.sharp,
			duration: theme.transitions.duration.leavingScreen,
		}),
	},
	appBarShift: {
		width: `calc(100% - ${drawerWidth}px) !important`,
		marginLeft: drawerWidth,
		transition: theme.transitions.create(['margin', 'width'], {
			easing: theme.transitions.easing.easeOut,
			duration: theme.transitions.duration.enteringScreen,
		}),
	},
	menuButton: {
		marginRight: theme.spacing(2),
	},
	hide: {
		display: 'none',
	},
	logo: {
		maxWidth: '150px',
	},
	iconsParent: {
		justifyContent: 'space-between',
	}
}))