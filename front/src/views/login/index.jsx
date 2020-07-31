import React, { useState } from 'react'
import Avatar from '@material-ui/core/Avatar';
import Button from '@material-ui/core/Button';
import TextField from '@material-ui/core/TextField';
import Link from '@material-ui/core/Link';
import Grid from '@material-ui/core/Grid';
import LockOutlinedIcon from '@material-ui/icons/LockOutlined';
import Typography from '@material-ui/core/Typography';
import useStyles from './use-styles'
import serviceLogin from '../../services/login'


export default function SignUp() {
  const styles = useStyles();
  const login = async () => {
    const payload = { name: inputUser, password: InputPassword };
    try {
      const responseLogin = await serviceLogin.login(payload);
      if (responseLogin.data.success) {
        localStorage.setItem('@codeigniter/token', responseLogin.data.token);
        window.location.assign("/home");
      }
    } catch (e) {
      alert("Ocorreu um erro ao tentar autenticar o usuário")
    }
  }

  const [inputUser, setUser] = useState("")
  const [InputPassword, setPassword] = useState("")

  return (
    <div className={styles.container}>
      <div className={styles.paper}>
        <Avatar className={styles.avatar}>
          <LockOutlinedIcon />
        </Avatar>
        <Typography component="h1" variant="h5">
          Bem-vindo, Faça seu login.
        </Typography>
        <form className={styles.form} id="login-form">
          <TextField
            variant="outlined"
            margin="normal"
            required
            fullWidth
            onChange={(ev) => setUser(ev.target.value)}
            label="Usuário"
            name="user"
            autoComplete="user"
            className="input"
            autoFocus
          />
          <TextField
            variant="outlined"
            margin="normal"
            required
            fullWidth
            name="password"
            onChange={(ev) => setPassword(ev.target.value)}
            label="Senha"
            type="password"
            autoComplete="current-password"
            className="input"
          />

          <Button
            variant="contained"
            color="primary"
            onClick={login}
            className={styles.submit}
            disabled={!(inputUser && InputPassword)}
          >
            Entrar
          </Button>
          <Grid container>
            <Grid item xs>
              <Link href="#" variant="body2">
                Esqueceu sua senha?
              </Link>
            </Grid>
          </Grid>
        </form>
      </div>
    </div>
  );
}