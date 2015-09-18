<div class="content">
    <h1>Register to Web App</h1>
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
            echo "<h2>Error register. Please try again.</h2>" . $saveError;
        }
        ?>
    </div><!--  .errors -->

    <div class="register">
        <form action="<?php echo BASE_PATH; ?>employees/register" method="post">
            <p>
                <label for="name">Name:</label>
                <input value="<?php if(isset($formData)) echo $formData['name']; ?>" type="text" id="name" name="name" />
            </p>
            
            <p>
                <label for="phone">Phone:</label>
                <input value="<?php if(isset($formData)) echo $formData['phone']; ?>" type="text" id="phone" name="phone" />
            </p>
            
            <p>
                <label for="email">Email:</label>
                <input value="<?php if(isset($formData)) echo $formData['email']; ?>" type="text" id="email" name="email" />
            </p>
            
            <p>
                <label for="address">Address:</label>
                <input value="<?php if(isset($formData)) echo $formData['address']; ?>" type="text" id="address" name="address" />
            </p>
            <p class="submit">
                <input type="submit" name="registerFormSubmit" value="register" />
            </p>
        </form>
    </div><!--  .register -->
</div><!--  .content -->
