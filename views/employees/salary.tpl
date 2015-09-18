<div class="content">
    <h1><?php echo $title; ?></h1>
    <?php if(isset($errors)): ?>
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
    <?php endif; ?>

    <div class="salary">
        <form action="" method="post">
            <p>
                <label for="lastname">Last Name:</label>
                <span><?php echo $employee['lastname']; ?></span>
            </p>

            <p>
                <label for="firstname">First Name:</label>
                <span><?php echo $employee['firstname']; ?></span>
            </p>

            <p>
                <label for="employee_type">Employee Type:</label>
                <select name="employee_type" id="employee_type">
                    <option selected="selected" value="<?php echo $employeetype['id']; ?>"><?php echo $employeetype['name']; ?></option>
                </select>
            </p>
            
            <?php if($employeetype['id'] == 1): ?>
                <p>
                    <label for="normal_salary">Salary*:</label>
                    <input value="<?php if(isset($formData)) echo $formData['normal_salary']; ?>" type="text" id="normal_salary" name="normal_salary" />
                </p>
            <?php elseif($employeetype['id'] == 2): ?> 
                <p>
                    <label for="worked_hour">Hourly Work*:</label>
                    <input value="<?php if(isset($formData)) echo $formData['worked_hour']; ?>" type="text" id="worked_hour" name="worked_hour" />
                </p>

                <p>
                    <label for="wageper_hour">Wage Per Hour*:</label>
                    <input value="<?php if(isset($formData)) echo $formData['wageper_hour']; ?>" type="text" id="wageper_hour" name="wageper_hour" />
                </p>
            <?php elseif($employeetype['id'] == 3): ?>
                <p>
                    <label for="basic_salary">Basic Salary*:</label>
                    <input value="<?php if(isset($formData)) echo $formData['basic_salary']; ?>" type="text" id="basic_salary" name="basic_salary" />
                </p>

                <p>
                    <label for="gross_sale">Gross Sale*:</label>
                    <input value="<?php if(isset($formData)) echo $formData['gross_sale']; ?>" type="text" id="gross_sale" name="gross_sale" />
                </p>

                <p>
                    <label for="commission_rate">Commission Rate*:</label>
                    <input value="<?php if(isset($formData)) echo $formData['commission_rate']; ?>" type="text" id="commission_rate" name="commission_rate" />
                </p>
            <?php endif; ?>

            <p>
                <label for="comment">Comment:</label>
                <textarea name="comment" id="comment" rows="10" cols='80'><?php if(isset($formData)) echo $formData['comment']; ?></textarea>
            </p>

            <p class="submit">
                <input type='hidden' name='user_id' id='user_id' value="<?php echo $employee['id']; ?>"/>
                <input type='hidden' name='employeetype_id' id='employeetype_id' value="<?php echo $employeetype['id']; ?>"/>
                <input type="submit" name="saveFormSubmit" value="Save" />
                <input type="submit" name="cancelFormSubmit" value="Cancel" />
            </p>
        </form>
    </div><!--  .salary -->
</div><!--  .content -->
