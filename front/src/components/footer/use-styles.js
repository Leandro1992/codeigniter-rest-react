import { makeStyles } from '@material-ui/core/styles'

export default makeStyles(theme => ({
	mainFooter: {
		position: 'fixed',
		bottom: '0',
		top: 'auto',
		height: '100px',
		backgroundColor: '#3AB54B !important',
		display:'flex',
		justifyContent: 'center',

	},


	paper:{
		backgroundColor: '#3AB54B !important',
		boxShadow: 'none',
		fontWeight: 'bolder',
		paddingBottom: 5,
		color:'white',
	},

	icon:{
		margin: 5
	}
}))