import { Drawer } from '@material-ui/core';
import { makeStyles, withStyles } from '@material-ui/core/styles'

const drawerWidth = 240;

export const Sidebar = withStyles(theme => ({
	paper: {
		backgroundColor:'#3AB54B',
		color: 'white'
	},
}))(Drawer)

export default makeStyles(theme => ({
	drawer: {
		width: drawerWidth,
		flexShrink: 0,
	},
	drawerPaper: {
		width: drawerWidth,
	},
	drawerHeader: {
		display: 'flex',
		alignItems: 'center',
		...theme.mixins.toolbar,
		justifyContent: 'flex-end',
	}
}))
