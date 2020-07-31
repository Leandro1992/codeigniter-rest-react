import { makeStyles } from '@material-ui/core/styles'

const drawerWidth = 240;

export default makeStyles(theme => ({
	root: {
		display: 'flex',
	},
	content: {
		display: 'flex',
		flexGrow: 1,
		// padding: theme.spacing(3),
		transition: theme.transitions.create('margin', {
			easing: theme.transitions.easing.sharp,
			duration: theme.transitions.duration.leavingScreen,
		}),
		margin: `60px 0px 0px ${-drawerWidth}px`,
	},
	contentShift: {
		transition: theme.transitions.create('margin', {
			easing: theme.transitions.easing.easeOut,
			duration: theme.transitions.duration.enteringScreen,
		}),
		marginLeft: 0,
	},
}));
