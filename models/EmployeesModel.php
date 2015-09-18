<?php
/**
 * Class EmployeesModel
 *
 * Handles the user's login / logout stuff
 * Calculate salary
 */
class EmployeesModel extends \Model
{
    // Using tbl_user
    private $employeetype_id;
    private $username;
    private $password;
    private $firstname;
    private $lastname;
    private $isaccountant;
    
    // Extend tbl_user
    private $name;
    private $phone;
    private $email;
    private $address;
    
    // Using tbl_weeklysalary
    private $user_id;
    private $comment;
    private $gross_salary;
    private $net_salary;
    
    /**
     * feature Register
     * List functions:
     * - checkValid(); return boolean value
     * - setData(); set data submit 
     * - register(); process register
     */
    
    public static function checkValid($postDatas){
        // Array save errors when validate.
        $result = array(
            'result' => true,
            'errors' => array()
        );
        $check = true;
        
        // Get value user input
        $username = isset($postDatas['username']) ? trim($postDatas['username']) : NULL;
        $password = isset($postDatas['password']) ? trim($postDatas['password']) : NULL;
        
        // User not enter username
        if (empty($username))
        {
            $result['result'] = false;
            array_push($result['errors'], "Users name is required!");
        }else{
            $result['result'] = $this->checkInputIsFullwidthKatakanaChars($username);
            array_push($result['errors'], "User name input must be Fullwidth Katakana");
        }
        
        // User not enter password
        if (empty($password))
        {
            $result['result'] = false;
            array_push($result['errors'], "Password is required!");
        }
        
        return $result;
    }
    
    function setData($postDatas){
        foreach($postDatas as $field => $value){
            if(isset($this->$field)){
                $this->$field = $value;
            }
        }
        return true;
    }
    
    function register(){
        try
        {
            // Password encrypt by SHA-2
            $password = hash('SHA256',$this->password);
            // Call login() method in the EmployeesModel, put the result in $employee (false or user data)
            $result = $employee->login($username,$password);
        
            // Check result returned
            if($result)
            {
                // Login success, write the user data into session
                Session::init();
                Session::set('user_logged_in', true);
                Session::set('user_id', $result['id']);
                Session::set('firstname', $result['firstname']);
                Session::set('lastname', $result['lastname']);
                Session::set('fullname', $result['firstname']." ".$result['lastname']);
                Session::set('employeetype_id', $result['employeetype_id']);
        
                // Redirect user to page list all Employees
                header('location: ' . BASE_PATH . 'employees/listemployees');
            }
        }
        catch (Exception $e)
        {
            $this->setView('login');
            $this->view->set('title', 'There was an error login the data!');
            $this->view->set('formData', $_POST);
            $this->view->set('saveError', $e->getMessage());
        }
    }
    
    /**
     * check name input is full width Katakana characters.
     *
     * @return false if check is not match
     * @return true if check is match
     */
    public function checkInputIsFullwidthKatakanaChars($name)
    {
        // Contains all full width katakana characters
        $pattern = "/^([゠ァアィイゥウェエォオカガキギクグケゲコゴサザシジスズセゼソゾタダチヂッツヅテデトドナニヌネノハバパヒビピフブプヘベペホボポマミムメモャヤュユョヨラリルレロヮワヰヱヲンヴヵヶヷヸヹヺ・ーヽヾヿ]+)$/u";

        if(preg_match($pattern, $name)){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * function check phone input format
     * @return boolean
     */
    
    function checkPhoneInputFormat($phone){
        //check phone length
        if(strlen($phone) > 12)
            return false;
        // check phone format
        return preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', trim($phone));
    }
    
    /**
     * Login process.
     * 
     * @return false if select empty
     * @return array if select exist
     */
    public function login($username,$password)
    {
        // Set query 
        $sql = "SELECT * FROM tbl_user WHERE username = ? AND password = ? AND isaccountant = 1";
        $this->setSql($sql);
        $employee = $this->getRow(array($username, $password));
        if (empty($employee))
        {
            return false;
        }
        
        return $employee;
    }
    
    /**
     * Returns the current state of the user's login
     * @return bool user's login status
     */
    public function isUserLoggedIn()
    {
        return Session::get('user_logged_in');
    }
    
    /**
     * Log out process, deletes cookie, deletes session
     */
    public function logout()
    {
        // Delete the session
        Session::destroy();
    }

    /**
     * Get list all employees.
     *
     * @return false if select empty
     * @return array if select exist
     */
    public function getAllEmployees()
    {
        // Set query 
        $sql = "SELECT * FROM tbl_user ORDER BY id DESC";

        $this->setSql($sql);
        $employees = $this->getAll();

        if (empty($employees))
        {
            return false;
        }

        return $employees;
    }

    /**
     * Get detail infomation employee by id.
     *
     * @return false if select empty
     * @return array if select exist
     */
    public function getEmployeeById($id)
    {
        // Set query
        $sql = "SELECT id, firstname, lastname FROM tbl_user WHERE id = ?";

        $this->setSql($sql);
        $employeeDetails = $this->getRow(array($id));

        if (empty($employeeDetails))
        {
            return false;
        }

        return $employeeDetails;
    }

    /**
     * Get detail infomation employee type by user_id.
     *
     * @return false if select empty
     * @return array if select exist
     */
    public function getEmployeetypeByUserId($user_id)
    {
        // Set query
        $sql = "SELECT et.id, et.name FROM tbl_user AS u LEFT JOIN tbl_employeetype AS et ON u.employeetype_id = et.id WHERE u.id = ?";

        $this->setSql($sql);
        $EmployeeType = $this->getRow(array($user_id));

        if (empty($EmployeeType))
        {
            return false;
        }

        return $EmployeeType;
    }
    
    /**
     * Get detail infomation weekly salary by id.
     *
     * @return false if select empty
     * @return array if select exist
     */
    public function getDetailWeeklySalaryById($id)
    {
        // Set query
        $sql = "SELECT user_id, basic_salary, worked_hour, gross_sale, commission_rate, gross_salary, net_salary, comment FROM tbl_weeklysalary WHERE id = ?";
    
        $this->setSql($sql);
        $detailWeeklySalary = $this->getRow(array($id));
    
        if (empty($detailWeeklySalary))
        {
            return false;
        }
    
        return $detailWeeklySalary;
    }
    
    /**
     * Calulate auto national person rate for user.
     * @param int $gross_salary
     * @return float
     */
    public function calculateNationalPersonRate($gross_salary)
    {
        // If gross salary < 2000
        if($gross_salary < 2000)
        {
            //Contribution rate will be 5%
            $pn_rate = 5;
        }
        // If gross salary between 2000 and 6000
        else if($gross_salary < 6000)
        {
            //Contribution rate will be 6.5%
            $pn_rate = 6.5;
        }
        // If gross salary between 6000 and 10000
        else if($gross_salary < 10000)
        {
            //Contribution rate will be 7.5%
            $pn_rate = 7.5;
        }
        // Else case above
        else
        {
            $pn_rate = 0;
        }
         
        return $pn_rate;
    }
    
    /**
     * Calulate auto salary before tax for user.
     * @param int $gross_salary
	 * @return int 
     */
    public function calculateSalaryBeforeTax($gross_salary)
	{
	    if($gross_salary == 0)
	    {
	        $beforeTax_salary = 0;
	    }
        else 
        {
            // Calulate auto national person by $gross_salary
            $pn_rate = $this->calculateNationalPersonRate($gross_salary);
            
            // Calculate salary before tax
            $beforeTax_salary = (int)($gross_salary - $gross_salary * $pn_rate/100);
        } 
	    return $beforeTax_salary;
	}
	
	/**
	 * Calulate auto tax rate for user.
	 * @param int $beforeTax_salary
	 * @return int
	 */
	public function calculateTaxRate($beforeTax_salary)
	{
	    // If salary before tax < 5000
	    if ($beforeTax_salary < 5000)
	    {
	        // Tax rate will be 5%
	        $tax_rate = 5;
	    }
	    //If salary before tax between 5000 and 10000
	    elseif ($beforeTax_salary < 10000)
	    {
	        // Tax rate will be 10%
	        $tax_rate = 10;
	    }
	    //If salary before tax between 10000 and 20000
	    elseif ($beforeTax_salary < 20000)
	    {
	        // Tax rate will be 15%
	        $tax_rate = 15;
	    }
	    // Else case above
	    else
	    {
	        $tax_rate = 0;
	    }
	     
	    return $tax_rate;
	}
    
    /**
     * Calulate auto net salary.
     * @param int $beforeTax_salary
	 * @return int  
     */
    public function calculateNetSalary($beforeTax_salary)
	{
	    if($beforeTax_salary == 0)
	    {
	        $net_salary = 0;
	    }
	    else
	    {
    	    // Calulate auto national person by $gross_salary
    	    $tax_rate = $this->calculateTaxRate($beforeTax_salary);
    	    
            // Calculate net salary
    	    $net_salary = (int) ($beforeTax_salary - $beforeTax_salary * $tax_rate/100);
	    }
	    return $net_salary;
	}

	
}
