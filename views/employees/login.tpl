<div class="content">
    <h1>Login to Web App</h1>
    <div class="errors">
        <?php 
        if (isset($errors)) 
                {
                    echo '<ul>';
                    foreach ($errors as $e)
                    {
                        echo '<li>' . $e . '</li>';
                    }
                    echo '</ul>';
                } 
                if (isset($saveError))
                {
                    echo "<h2>Error login. Please try again.</h2>" . $saveError;
                }
                ?>
    </div><!--  .errors -->

    <div class="login">
        <form action="<?php echo BASE_PATH; ?>employees/login" method="post">
            <p>
                <label for="username">User Name:</label>
                <input value="<?php if(isset($formData)) echo $formData['username']; ?>" type="text" id="username" name="username" />
            </p>
            
            <p>
                <label for="password">Password:</label>
                <input value="<?php if(isset($formData)) echo $formData['password']; ?>" type="text" id="password" name="password" />
            </p>
            <p class="submit">
                <input type="submit" name="loginFormSubmit" value="login" />
            </p>
        </form>
    </div><!--  .login -->
</div><!--  .content -->
