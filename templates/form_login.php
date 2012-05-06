<form action="index.php" method="POST" name="login" id="formLogin">
        <fieldset>
            <legend>Login</legend>
            <div>
                <label for="user">Usuario: </label>
                <input type="text" name="user" id="user" maxlength="15" />
            </div>
            <div>
            <label for="pass">Contraseña: </label>
            <input type="password" name="pass" id="pass" maxlength="15" />
            </div>
            <cite id="errorLogin">
                <?php
                    if(is_array($out))
                     foreach ($out as $error) { echo $error.'<br>'; }
                ?>
            </cite>
            <input id="blogin"class="login" type="submit" value="Entrar" />
        </fieldset>
</form>