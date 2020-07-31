import { makeStyles, withStyles } from '@material-ui/core/styles'
import Avatar from '@material-ui/core/Avatar';
import Button from '@material-ui/core/Button';

export const GreenAvatar = withStyles({
	root: {
		color: '#fff',
		margin: '20px auto',
		backgroundColor: '#3AB54B',
	},
  })(Avatar)

  export const MyButton = withStyles({
	root: {
		color: '#fff',
		backgroundColor: '#3AB54B',
		marginLeft: '10px'
	},
  })(Button)

export default makeStyles((theme) => ({
	container: {
		marginTop: '50px',
	},
	form: {
		width: '100%',
	},
	download: {
		textDecoration: 'none',
		color: 'inherit'
	}
}))
